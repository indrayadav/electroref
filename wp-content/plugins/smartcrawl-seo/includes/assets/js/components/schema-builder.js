import React from 'react';
import SchemaTypeCondition from "./schema-type-condition";
import update from 'immutability-helper';
import {parseInt, uniqueId} from "lodash-es";
import {__, _n, sprintf} from '@wordpress/i18n';
import SchemaPropertySimple from "./schema-property-simple";
import Modal from "./modal";
import Button from "./button";
import schemaProperties from "./schema-properties";
import schemaTypesList from "./schema-types";
import Dropdown from "./dropdown";
import classnames from 'classnames';
import $ from 'jQuery';
import SUI from 'SUI';
import Config_Values from "../es6/config-values";
import BoxSelectorModal from "./box-selector-modal";
import AddSchemaTypeWizardModal from "./add-schema-type-wizard-modal";
import SchemaTypeLocations from "./schema-type-locations";
import {createInterpolateElement} from '@wordpress/element';
import schemaTypesHierarchy from "./schema-types-hierarchy";

export default class SchemaBuilder extends React.Component {
	constructor(props) {
		super(props);

		this.props = props;
		this.state = {
			initialized: false,
			types: {},
			deletingProperty: '',
			deletingPropertyId: 0,
			addingProperties: '',
			addingNestedForProperty: 0,
			addingSchemaTypes: false,
			resettingProperties: '',
			renamingType: '',
			newName: '',
			deletingType: '',
			changingPropertyTypeForId: 0,
			openTypes: [],
			invalidTypes: [],
		};
		this.accordionElement = React.createRef();
	}

	componentDidMount() {
		this.hookNestedAccordions();
		this.maybeInitializeComponent();
		this.maybeStartAddingSchemaType();
	}

	hookNestedAccordions() {
		const $accordion = $(this.accordionElement.current);
		$accordion.on('click', '.sui-accordion-item-body .sui-accordion-item-header', function (event) {
			const clickedTarget = $(event.target);
			if (clickedTarget.closest('.sui-accordion-item-action').length) {
				return true;
			}

			$(this).closest('.sui-accordion-item').toggleClass('sui-accordion-item--open');
		});
	}

	maybeInitializeComponent() {
		if (this.state.initialized) {
			return;
		}

		const schemaTypes = {};
		const savedSchemaTypes = Config_Values.get('types', 'schema_types');
		const initializedTypeIds = [];
		Object.keys(savedSchemaTypes).forEach((schemaTypeKey) => {
			const savedSchemaType = savedSchemaTypes[schemaTypeKey];
			const typeId = this.generateTypeId(savedSchemaType.type);
			const properties = this.cloneProperties(savedSchemaType.properties);
			const conditions = this.cloneConditions(savedSchemaType.conditions);

			schemaTypes[typeId] = Object.assign({}, savedSchemaType, {
				conditions: conditions,
				properties: properties
			});

			initializedTypeIds.push(typeId);
		});

		this.setState({
			types: schemaTypes,
			initialized: true
		}, () => {
			const invalidTypes = [];
			initializedTypeIds.forEach((initializedTypeId) => {
				if (this.typeHasMissingRequiredProperties(initializedTypeId)) {
					invalidTypes.push(initializedTypeId);
				}
			});
			this.setState({invalidTypes: invalidTypes});
			if (
				invalidTypes.length
				&& Config_Values.get('settings_updated', 'schema_types')
			) {
				this.showInvalidTypesNotice();
			}
		});
	}

	formatSpec(keys, operation) {
		keys.slice().reverse().forEach(key => {
			operation = {[key]: operation};
		});

		return operation;
	}

	defaultCondition(typeKey) {
		const type = this.getType(typeKey);
		const schemaTypeDefinition = schemaTypesList[type.type];
		const fallback = {id: uniqueId(), lhs: 'post_type', operator: '=', rhs: 'post'};

		let condition = false;
		if (schemaTypeDefinition.condition) {
			condition = schemaTypeDefinition.condition;
		} else if (
			schemaTypeDefinition.parent
			&& schemaTypesList[schemaTypeDefinition.parent].condition
		) {
			condition = schemaTypesList[schemaTypeDefinition.parent].condition
		}

		return condition
			? Object.assign({}, condition, {id: uniqueId()})
			: fallback;
	}

	addGroup(typeKey) {
		const newIndex = this.getType(typeKey).conditions.length;
		const spec = this.formatSpec([typeKey, 'conditions'], {
			$splice: [
				[newIndex, 0, [this.defaultCondition(typeKey)]]
			]
		});
		this.updateTypes(spec);
	}

	updateTypes(spec) {
		return new Promise(resolve => {
			this.setState({types: update(this.state.types, spec)}, () => {
				resolve();
			});
		});
	}

	addCondition(typeKey, id) {
		const type = this.getType(typeKey);
		const groupIndex = this.conditionGroupIndex(type.conditions, id);
		const conditionIndex = this.conditionIndex(type.conditions[groupIndex], id);
		const newConditionIndex = conditionIndex + 1;
		const spec = this.formatSpec(
			[typeKey, 'conditions', groupIndex],
			{
				$splice: [[newConditionIndex, 0, this.defaultCondition(typeKey)]]
			}
		);

		this.updateTypes(spec);
	}

	updateCondition(typeKey, id, lhs, operator, rhs) {
		const type = this.getType(typeKey);
		const groupIndex = this.conditionGroupIndex(type.conditions, id);
		const conditionIndex = this.conditionIndex(type.conditions[groupIndex], id);
		const spec = this.formatSpec(
			[typeKey, 'conditions', groupIndex, conditionIndex],
			{
				lhs: {$set: lhs},
				operator: {$set: operator},
				rhs: {$set: rhs}
			}
		);

		this.updateTypes(spec);
	}

	deleteCondition(typeKey, id) {
		const type = this.getType(typeKey);
		const groupIndex = this.conditionGroupIndex(type.conditions, id);
		const group = type.conditions[groupIndex];
		let spec;
		if (group.length === 1) {
			spec = this.formatSpec([typeKey, 'conditions'], {
				$splice: [[groupIndex, 1]]
			});
		} else {
			const conditionIndex = this.conditionIndex(group, id);
			spec = this.formatSpec([typeKey, 'conditions', groupIndex], {
				$splice: [[conditionIndex, 1]]
			});
		}

		this.updateTypes(spec);
	}

	startAddingProperties(typeKey) {
		this.setState({
			addingProperties: typeKey,
		});
	}

	handleAddPropertiesButtonClick(typeKey, addedProperties) {
		this.addProperties(typeKey, addedProperties).then((newPropertyIds) => {
			newPropertyIds.forEach((newPropertyId) => {
				this.openAccordionItemForPropertyOrAlt(typeKey, newPropertyId);
			});

			this.checkTypeValidity(typeKey);

			this.showNotice(_n(
				'The property has been added. You need to save the changes to make them live.',
				'The properties have been added. You need to save the changes to make them live.',
				newPropertyIds.length,
				'wds'
			));
		});
		this.stopAddingProperties();
	}

	getPropertiesForType(type) {
		const schemaTypeDefinition = schemaTypesList[type];
		const propertiesKey = schemaTypeDefinition.parent
			? schemaTypeDefinition.parent
			: type;

		return schemaProperties[propertiesKey];
	}

	openAccordionItemForPropertyOrAlt(typeKey, newPropertyId) {
		const property = this.getPropertyById(
			newPropertyId,
			this.getType(typeKey).properties
		);
		if (this.hasAltVersions(property)) {
			const activeAltVersion = this.getActiveAltVersion(property);
			this.openAccordionItemForProperty(activeAltVersion.id);
		} else {
			this.openAccordionItemForProperty(newPropertyId);
		}
	}

	addProperties(typeKey, propertyIds) {
		const type = this.getType(typeKey);
		const newPropertyIds = [];
		let updatedProperties = type.properties,
			newPropertyId;
		propertyIds.forEach(propertyId => {
			[updatedProperties, newPropertyId] = this.addProperty(
				propertyId,
				this.getPropertiesForType(type.type),
				updatedProperties
			);
			newPropertyIds.push(...newPropertyId);
		});

		const spec = this.formatSpec([typeKey, 'properties'], {$set: updatedProperties});
		return new Promise(resolve => {
			this.updateTypes(spec).then(() => resolve(newPropertyIds));
		});
	}

	typeHasMissingRequiredProperties(typeKey) {
		const type = this.getType(typeKey);
		return this.requiredPropertiesMissing(
			type.properties,
			this.getPropertiesForType(type.type)
		);
	}

	requiredPropertiesMissing(subjectProperties, sourceProperties) {
		let hasMissingProperties = false;

		Object.keys(sourceProperties).some(sourcePropertyKey => {
			const sourceProperty = sourceProperties[sourcePropertyKey];
			// We know that nested properties are not going to be required if the parent property itself is not required
			// An exception to this rule is local business -> review -> author but that doesn't matter because it is inside a repeatable and is always valid
			if (sourceProperty.required) {
				if (!subjectProperties.hasOwnProperty(sourcePropertyKey)) {
					hasMissingProperties = true;
					return true;
				} else if (
					this.isNestedProperty(sourceProperty)
					&& this.isNestedProperty(subjectProperties[sourcePropertyKey])
				) {
					const hasNestedMissingProperties = this.requiredPropertiesMissing(
						subjectProperties[sourcePropertyKey].properties,
						sourceProperty.properties
					);
					if (hasNestedMissingProperties) {
						hasMissingProperties = true;
						return true;
					}
				}
			}
		});

		return hasMissingProperties;
	}

	addProperty(sourcePropertyId, sourceProperties, targetProperties) {
		const newPropertyIds = [];
		let updatedProperties = targetProperties;
		Object.keys(sourceProperties).some(sourcePropertyKey => {
			const sourceProperty = sourceProperties[sourcePropertyKey];
			if (sourceProperty.id === sourcePropertyId) {
				const newProperty = this.getDefaultProperty(sourceProperty);
				updatedProperties = update(updatedProperties, {
					[sourcePropertyKey]: {$set: newProperty}
				});
				newPropertyIds.push(newProperty.id);
				return true;
			} else if (
				this.isNestedProperty(sourceProperty)
				&& targetProperties.hasOwnProperty(sourcePropertyKey)
				&& this.isNestedProperty(targetProperties[sourcePropertyKey])
			) {
				const [nestedUpdatedProperties, newNestedPropertyIds] = this.addProperty(
					sourcePropertyId,
					sourceProperty.properties,
					targetProperties[sourcePropertyKey].properties
				);
				updatedProperties = update(updatedProperties, {
					[sourcePropertyKey]: {properties: {$set: nestedUpdatedProperties}}
				});
				newPropertyIds.push(...newNestedPropertyIds);
			}
		});

		return [updatedProperties, newPropertyIds];
	}

	stopAddingProperties() {
		this.setState({
			addingProperties: '',
			addingNestedForProperty: 0,
		});
	}

	updateProperty(typeKey, id, source, value) {
		const type = this.getType(typeKey);
		const propertyKeys = this.propertyKeys(id, type.properties);
		const spec = this.formatSpec([typeKey, 'properties', ...propertyKeys], {
			source: {$set: source},
			value: {$set: value},
		});
		this.updateTypes(spec);
	}

	startDeletingProperty(typeKey, id) {
		this.setState({
			deletingProperty: typeKey,
			deletingPropertyId: id
		});
	}

	handleDeleteButtonClick(typeKey) {
		this.deleteProperty(typeKey, this.state.deletingPropertyId).then(() => {
			this.checkTypeValidity(typeKey);

			this.stopDeletingProperty();
		});
	}

	deleteProperty(typeKey, id) {
		const type = this.getType(typeKey);
		const spec = this.formatSpec([typeKey, 'properties'], {
			$set: this.deletePropertyById(id, type.properties)
		});

		this.showNotice(__('The property has been removed from this module.', 'wds'), 'info');
		return this.updateTypes(spec);
	}

	deletePropertyById(id, properties) {
		let updatedProperties = properties;
		Object.keys(properties).some((propertyKey) => {
			const property = properties[propertyKey];
			if (id === property.id) {
				updatedProperties = update(updatedProperties, {
					$unset: [propertyKey]
				});
				return true;
			} else if (this.isNestedProperty(property)) {
				const updatedNestedProperties = this.deletePropertyById(id, property.properties);
				const deletedAltVersion = this.hasAltVersions(property)
					&& Object.keys(updatedNestedProperties).length !== Object.keys(property.properties).length;
				let spec;
				if (deletedAltVersion || this.objectEmpty(updatedNestedProperties)) {
					spec = {$unset: [propertyKey]};
				} else {
					spec = {[propertyKey]: {properties: {$set: updatedNestedProperties}}};
				}
				updatedProperties = update(updatedProperties, spec);
			}
		});

		return updatedProperties;
	}

	objectEmpty(obj) {
		return !this.objectLength(obj);
	}

	objectLength(obj) {
		return Object.keys(obj).length;
	}

	stopDeletingProperty() {
		this.setState({
			deletingProperty: '',
			deletingPropertyId: 0
		});
	}

	getPropertyByKeys(propertyKeys, properties) {
		let property = properties;
		propertyKeys.forEach(key => {
			property = property[key];
		});
		return property;
	}

	/**
	 * @param id
	 * @param properties
	 *
	 * @return {Array}
	 */
	propertyKeys(id, properties) {
		return this.findPropertyKeys((property) => {
			return property.hasOwnProperty('id') && property.id === id;
		}, properties);
	}

	findPropertyKeys(callback, properties) {
		let keys = [];

		Object.keys(properties).some(propertyKey => {
			if (callback(properties[propertyKey])) {
				keys.unshift(propertyKey);
				return true;
			} else if (this.isNestedProperty(properties[propertyKey])) {
				const nestedKeys = this.findPropertyKeys(callback, properties[propertyKey].properties);
				if (nestedKeys.length) {
					keys.unshift(propertyKey, 'properties', ...nestedKeys);
					return true;
				}
			}
		});

		return keys;
	}

	conditionGroupIndex(conditions, id) {
		return conditions.findIndex(conditions => this.conditionIndex(conditions, id) > -1);
	}

	conditionIndex(conditions, id) {
		return conditions.findIndex(condition => condition.id === id);
	}

	render() {
		return (
			<React.Fragment>
				{!!this.state.invalidTypes.length
				&& this.getWarningElement(createInterpolateElement(
					__('One or more types have properties that are required by Google that have been removed. Please check your types and click on the <strong>Add Property</strong> button to add the missing <strong>required properties</strong> ( <span>*</span> ), for your content to be eligible for display as a rich result. To learn more about schema type properties, see our <DocLink>Schema Documentation</DocLink>.'),
					{
						strong: <strong/>,
						span: <span/>,
						DocLink: <a
							target="_blank"
							href="https://wpmudev.com/docs/wpmu-dev-plugins/smartcrawl/#schema"/>,
					}
				))}

				<div id="wds-schema-types-body" className={classnames({
					'hidden': !Object.keys(this.state.types).length
				})}>
					<div className="sui-row">
						<div className="sui-col-md-5">
							<small><strong>{__('Schema Type', 'wds')}</strong></small>
						</div>
						<div className="sui-col-md-7">
							<small><strong>{__('Location', 'wds')}</strong></small>
						</div>
					</div>
					<div className="sui-accordion sui-accordion-flushed" ref={this.accordionElement}>
						{Object.keys(this.state.types).map(typeKey => {
								const type = this.getType(typeKey);
								return <React.Fragment>
									<div className={classnames(
										'sui-accordion-item',
										this.getTypeAccordionItemClassName(typeKey),
										{
											'sui-accordion-item--open': this.state.openTypes.includes(typeKey),
											'sui-accordion-item--disabled':
												(this.isWooCommerceProduct(type.type) && !this.isWooCommerceActive())
												|| type.disabled
										}
									)}>
										{this.getTypeAccordionItemHeaderElement(typeKey)}

										<div className="sui-accordion-item-body">
											{this.state.openTypes.includes(typeKey) &&
											<div>
												{this.getSchemaTypeRulesElement(typeKey, this.getType(typeKey).conditions)}
												{this.getPropertiesTableElement(typeKey, this.getType(typeKey).properties)}
											</div>
											}

											{this.isProduct(type.type) &&
											<span className="wds-type-sub-text">
												{createInterpolateElement(
													__('Note: You must include one of the following properties: <strong>review</strong>, <strong>aggregateRating</strong> or <strong>offers</strong>. Once you include one of either a review or aggregateRating or offers, the other two properties will become recommended by the Rich Results Test.', 'wds'),
													{strong: <strong/>}
												)}
											</span>
											}
										</div>
									</div>

									{this.state.deletingProperty === typeKey && this.getPropertyDeletionModalElement(typeKey)}
									{this.state.addingProperties === typeKey && this.getAddTypePropertyModalElement(typeKey)}
									{this.state.resettingProperties === typeKey && this.getPropertyResetModalElement(typeKey)}
									{this.state.renamingType === typeKey && this.getTypeRenameModalElement(typeKey)}
									{this.state.deletingType === typeKey && this.getTypeDeleteModalElement(typeKey)}
								</React.Fragment>;
							}
						)}
					</div>
				</div>

				<div id="wds-schema-types-footer">
					<button type="button"
							onClick={() => this.startAddingSchemaType()}
							className="sui-button sui-button-dashed">

						<span className="sui-icon-plus" aria-hidden="true"/>
						{__('Add New Type', 'wds')}
					</button>

					<p className="sui-description">
						{__('Add additional schema types you want to output on this site.', 'wds')}
					</p>

					{this.getNextTypesNotice()}
					{this.getSaveSettingsFooter()}
				</div>

				{this.state.addingSchemaTypes && this.getAddSchemaModalElement()}
				{this.getStateInput()}
			</React.Fragment>
		);
	}

	getPropertiesTableElement(typeKey, properties) {
		return <table className="sui-table">
			<thead>
			<tr>
				<th>{__('Property', 'wds')}</th>
				<th>{__('Source', 'wds')}</th>
				<th colSpan={2}>{__('Value', 'wds')}</th>
			</tr>
			</thead>

			<tbody>
			{this.getPropertyElements(typeKey, properties)}
			</tbody>

			<tfoot>
			<tr>
				<td colSpan={4}>
					<div>
						<span className="sui-tooltip" data-tooltip={__('Reset the properties list to default.', 'wds')}>
						<Button ghost={true}
								onClick={() => this.startResettingProperties(typeKey)}
								icon="sui-icon-refresh"
								text={__('Reset Properties', 'wds')}
						/>
						</span>

						<Button icon="sui-icon-plus"
								onClick={() => this.startAddingProperties(typeKey)}
								text={__('Add Property', 'wds')}
						/>
					</div>
				</td>
			</tr>
			</tfoot>
		</table>;
	}

	getSchemaTypeRulesElement(typeKey, conditions) {
		return <div className="wds-schema-type-rules">
			<span className="sui-icon-link" aria-hidden="true"/>
			<small>
				<strong>{__('Location', 'wds')}</strong>
			</small>
			<span className="sui-description">
				{__('Create a set of rules to determine where this schema.org type will be enabled or excluded.', 'wds')}
			</span>

			{this.getConditionGroupElements(typeKey, conditions)}

			<Button text={__('Add Rule (Or)', 'wds')}
					ghost={true}
					onClick={() => this.addGroup(typeKey)}
					icon="sui-icon-plus"/>
		</div>;
	}

	checkTypeValidity(typeKey) {
		const invalid = this.typeHasMissingRequiredProperties(typeKey);
		this.setTypeInvalid(typeKey, invalid);
	}

	isTypeInvalid(typeKey) {
		return this.state.invalidTypes.includes(typeKey);
	}

	setTypeInvalid(typeKey, invalid) {
		const alreadyInvalid = this.isTypeInvalid(typeKey);
		let newInvalidTypes = this.state.invalidTypes.slice();
		if (invalid && !alreadyInvalid) {
			newInvalidTypes.push(typeKey);
		} else if (!invalid && alreadyInvalid) {
			newInvalidTypes = this.state.invalidTypes.filter((element => element !== typeKey));
		}

		return this.setState({
			invalidTypes: newInvalidTypes
		});
	}

	handleTypeStatusChange(typeKey, checked) {
		const spec = this.formatSpec([typeKey, 'disabled'], {
			$set: !checked
		});
		this.updateTypes(spec).then(() => {
			let message;
			if (checked) {
				message = __('You have successfully activated the %s type.', 'wds');
			} else {
				message = __('You have successfully deactivated the %s type.', 'wds');
			}
			this.showNotice(sprintf(message, this.getType(typeKey).label));
		});
	}

	handleTypeAccordionItemToggle(event, typeKey) {
		const clickedTarget = $(event.target);
		if (clickedTarget.closest('.sui-accordion-item-action').length) {
			return true;
		}

		this.toggleType(typeKey);
	}

	toggleType(typeKey) {
		let newOpenTypes;
		if (this.state.openTypes.includes(typeKey)) {
			newOpenTypes = this.state.openTypes.filter((element => element !== typeKey));
		} else {
			newOpenTypes = this.state.openTypes.slice();
			newOpenTypes.push(typeKey);
		}

		return this.setState({
			openTypes: newOpenTypes
		});
	}

	getTypeAccordionItemHeaderElement(typeKey) {
		const type = this.getType(typeKey);

		return <div className="sui-accordion-item-header wds-type-accordion-item-header"
					onClick={(event) => this.handleTypeAccordionItemToggle(event, typeKey)}>
			<div className="sui-accordion-item-title sui-accordion-col-5">
				<span className={this.getSchemaTypeIcon(type.type)}/>
				<span>{type.label}</span>
				{this.isTypeInvalid(typeKey) &&
				<span className="sui-tooltip sui-tooltip-constrained"
					  data-tooltip={__('This type has missing properties that are required by Google.', 'wds')}>
					<span className="wds-invalid-type-icon sui-icon-warning-alert sui-md"
						  aria-hidden="true"/>
				</span>
				}
			</div>

			<div className="sui-accordion-col-3">
				<SchemaTypeLocations conditions={type.conditions}/>
			</div>

			<div className="sui-accordion-col-4">
				<label className="sui-toggle sui-accordion-item-action">
					<input type="checkbox" defaultChecked={!this.getType(typeKey).disabled}
						   onChange={(e) => this.handleTypeStatusChange(typeKey, e.target.checked)}
					/>
					<span aria-hidden="true" className="sui-toggle-slider"/>
				</label>
				<Dropdown buttons={[
					<button onClick={() => this.startRenamingType(typeKey)}
							type="button">
						<span className="sui-icon-pencil" aria-hidden="true"/>
						{__('Rename', 'wds')}
					</button>,
					<button onClick={() => this.duplicateType(typeKey)}
							type="button">
						<span className="sui-icon-copy" aria-hidden="true"/>
						{__('Duplicate', 'wds')}
					</button>,
					<button onClick={() => this.startDeletingType(typeKey)}
							type="button">
						<span className="sui-icon-trash" aria-hidden="true"/>
						{__('Delete', 'wds')}
					</button>,
				]}/>

				<button className="sui-button-icon sui-accordion-open-indicator"
						type="button"
						onClick={(event) => this.handleTypeAccordionItemToggle(event, typeKey)}
						aria-label={__('Open item', 'wds')}>
					<span className="sui-icon-chevron-down" aria-hidden="true"/>
				</button>
			</div>
		</div>;
	}

	getPropertyDeletionModalElement(typeKey) {
		const property = this.getPropertyById(this.state.deletingPropertyId, this.getType(typeKey).properties);
		const description = property.required ?
			__('You are trying to delete a property that is required by Google. Are you sure you wish to delete it anyway?', 'wds') :
			__('Are you sure you wish to delete this property? You can add it again anytime.', 'wds');

		return <Modal small={true}
					  id="wds-confirm-property-deletion"
					  title={__('Are you sure?', 'wds')}
					  onClose={() => this.stopDeletingProperty()}
					  focusAfterOpen="wds-schema-property-delete-button"
					  description={description}>

			<Button text={__('Cancel', 'wds')}
					onClick={() => this.stopDeletingProperty()}
					ghost={true}
			/>

			<Button text={__('Delete', 'wds')}
					onClick={() => this.handleDeleteButtonClick(typeKey)}
					icon="sui-icon-trash"
					color="red"
					id="wds-schema-property-delete-button"
			/>
		</Modal>;
	}

	getAddTypePropertyModalElement(typeKey) {
		const type = this.getType(typeKey);
		const options = this.preparePropertySelectorOptions(type.properties, this.getPropertiesForType(type.type));

		return this.getAddPropertyModalElement(typeKey, options, sprintf(
			__('Choose the properties to insert into your %s type module.', 'wds'),
			type.label
		));
	}

	getAddNestedPropertyModalElement(typeKey, propertyId) {
		const type = this.getType(typeKey);
		const propertyKeys = this.propertyKeys(propertyId, type.properties);
		const targetProperty = this.getPropertyByKeys(propertyKeys, type.properties);
		const sourceProperty = this.getPropertyByKeys(propertyKeys, this.getPropertiesForType(type.type));
		const options = this.preparePropertySelectorOptions(targetProperty.properties, sourceProperty.properties);

		return this.getAddPropertyModalElement(typeKey, options, sprintf(
			__('Choose the properties to insert into the %s section of your %s schema.', 'wds'),
			sourceProperty.label,
			type.label
		));
	}

	getAddPropertyModalElement(typeKey, options, description) {
		return <BoxSelectorModal
			id="wds-add-property"
			title={__('Add Properties', 'wds')}
			description={description}
			actionButtonText={__('Add', 'wds')}
			actionButtonIcon="sui-icon-plus"
			onClose={() => this.stopAddingProperties()}
			onAction={(propertyIds) => this.handleAddPropertiesButtonClick(typeKey, propertyIds)}
			options={options}
			noOptionsMessage={
				<div className="wds-box-selector-message">
					<h3>{__('No properties to add', 'wds')}</h3>
					<p className="sui-description">{__('It seems that you have already added all the available properties.', 'wds')}</p>
				</div>
			}
			requiredNotice={this.getWarningElement(createInterpolateElement(
				__('You are missing properties that are required by Google ( <span>*</span> ). Make sure you include all of them so that your content will be eligible for display as a rich result. To learn more about schema type properties, see our <a>Schema Documentation</a>.'),
				{
					span: <span/>,
					a: <a
						target="_blank"
						href="https://wpmudev.com/docs/wpmu-dev-plugins/smartcrawl/#schema"/>,
				}
			))}
		/>;
	}

	getWarningElement(message) {
		return <div className="wds-missing-properties-notice sui-notice sui-notice-warning">
			<div className="sui-notice-content">
				<div className="sui-notice-message">
					<span className="sui-notice-icon sui-icon-warning-alert sui-md" aria-hidden="true"/>
					<p>{message}</p>
				</div>
			</div>
		</div>;
	}

	preparePropertySelectorOptions(typeProperties, sourceProperties) {
		const selectorOptions = [];
		Object.keys(sourceProperties).forEach((sourcePropertyKey) => {
			const sourceProperty = sourceProperties[sourcePropertyKey];

			if (!typeProperties.hasOwnProperty(sourcePropertyKey)) {
				selectorOptions.push({
					id: sourceProperty.id,
					label: sourceProperty.label,
					required: sourceProperty.required
				});
			}
		});

		return selectorOptions;
	}

	getConditionGroupElements(typeKey, conditions) {
		return conditions.map((conditionGroup, conditionGroupIndex) =>
			<div className="wds-schema-type-condition-group">
				{conditionGroupIndex === 0 && <span>{__('Rule', 'wds')}</span>}
				{conditionGroupIndex !== 0 && <span>{__('Or', 'wds')}</span>}
				{this.getConditionElements(typeKey, conditionGroup, conditionGroupIndex)}
			</div>
		);
	}

	getConditionElements(typeKey, conditionGroup, conditionGroupIndex) {
		return conditionGroup.map((condition, conditionIndex) =>
			<SchemaTypeCondition
				onChange={(id, lhs, operator, rhs) => this.updateCondition(typeKey, id, lhs, operator, rhs)}
				onAdd={(id) => this.addCondition(typeKey, id)}
				onDelete={(id) => this.deleteCondition(typeKey, id)}
				disableDelete={conditionGroupIndex === 0 && conditionIndex === 0}
				key={condition.id} id={condition.id}
				lhs={condition.lhs} operator={condition.operator}
				rhs={condition.rhs}/>
		);
	}

	isNestedProperty(property) {
		return property.properties;
	}

	isFlatNestedProperty(property) {
		return property.properties && property.flatten;
	}

	getActiveAltVersion(property) {
		return property.properties[property.activeVersion];
	}

	hasLoop(property) {
		return !!property.loop;
	}

	hasAltVersions(property) {
		return this.isNestedProperty(property) && !!property.activeVersion && property.properties.hasOwnProperty(property.activeVersion);
	}

	getPropertyElements(typeKey, properties) {
		const elements = [];
		Object.keys(properties).forEach((propertyKey) => {
			const property = properties[propertyKey];

			elements.push(this.getPropertyElement(typeKey, property));
		});

		return elements;
	}

	getPropertyElement(typeKey, property, isAnAltVersion = false) {
		if (this.hasAltVersions(property)) {
			return this.getPropertyElement(typeKey, this.getActiveAltVersion(property), true);
		} else if (this.isPropertyRepeatable(property)) {
			return this.getRepeatingPropertyElements(typeKey, property, isAnAltVersion);
		} else if (this.isFlatNestedProperty(property)) {
			return this.getPropertyElements(typeKey, property.properties);
		} else if (this.isNestedProperty(property)) {
			return this.getNestedPropertyElements(typeKey, property, isAnAltVersion);
		} else {
			return this.getSimplePropertyElement(typeKey, property);
		}
	}

	getSimplePropertyElement(typeKey, property) {
		return <SchemaPropertySimple
			{...property}
			onChange={(id, source, value) => this.updateProperty(typeKey, id, source, value)}
			onDelete={id => this.startDeletingProperty(typeKey, id)}
		/>;
	}

	getDefaultProperties(properties) {
		const defaultProperties = {};
		Object.keys(properties).forEach((propertyKey) => {
			const property = properties[propertyKey];
			if (!property.optional) {
				defaultProperties[propertyKey] = this.getDefaultProperty(property);
			}
		});

		return defaultProperties;
	}

	getDefaultProperty(property) {
		const args = [{}, property];
		if (this.isNestedProperty(property)) {
			args.push({
				properties: this.getDefaultProperties(property.properties)
			});
		}
		args.push({id: uniqueId()});
		return Object.assign({}, ...args);
	}

	cloneConditions(conditionGroups) {
		const clonedConditionGroup = [];
		conditionGroups.forEach((conditions) => {
			const clonedConditions = [];
			conditions.forEach((condition) => {
				clonedConditions.push(Object.assign(
					{},
					condition,
					{id: uniqueId()}
				));
			});
			clonedConditionGroup.push(clonedConditions);
		});
		return clonedConditionGroup;
	}

	cloneProperties(properties) {
		const clonedProperties = {};
		Object.keys(properties).forEach((propertyKey) => {
			clonedProperties[propertyKey] = this.cloneProperty(properties[propertyKey]);
		});

		return clonedProperties;
	}

	cloneProperty(property) {
		const args = [{}, property];
		if (this.isNestedProperty(property)) {
			args.push({
				properties: this.cloneProperties(property.properties)
			});
		}
		args.push({id: uniqueId()});
		return Object.assign({}, ...args);
	}

	startAddingSchemaType() {
		this.setState({
			addingSchemaTypes: true,
		});
	}

	stopAddingSchemaType() {
		this.removeAddTypeQueryVar();

		this.setState({
			addingSchemaTypes: false,
		});
	}

	handleAddSchemaTypesButtonClick(schemaType, label, conditions) {
		this.addSchemaType(schemaType, label, conditions)
			.then((typeKey) => {
				this.stopAddingSchemaType();
				this.showNotice(__('The type has been added. You need to save the changes to make them live.', 'wds'));
				if (this.isLocalBusinessType(schemaType)) {
					this.showLocalBusinessNotice();
				}
				this.toggleType(typeKey);
			});
	}

	isLocalBusinessType(needle, types = false) {
		if (needle === 'LocalBusiness') {
			return true;
		}

		if (!types) {
			types = schemaTypesHierarchy['LocalBusiness'];
		}

		let found = false;
		Object.keys(types).some((schemaType) => {
			if (schemaType === needle) {
				found = true;
			} else if (types[schemaType]) {
				found = this.isLocalBusinessType(needle, types[schemaType]);
			}
			return found;
		});
		return found;
	}

	showInvalidTypesNotice() {
		let message = __('One or more properties that are required by Google have been removed. Please check your types and click on the <strong>Add Property</strong> button to see the missing <strong>required properties</strong> ( <span>*</span> ).');
		SUI.openNotice('wds-schema-types-invalid-notice', '<p>' + message + '</p>', {
			type: 'warning', icon: 'warning-alert', dismiss: {show: true}
		});
	}

	showLocalBusinessNotice() {
		let message = sprintf(
			__('If you wish to add a Local Business with <strong>multiple locations</strong>, you can easily do this by duplicating your Local Business type and editing the properties. Alternatively, you can just add a new Local Business type. To learn more, see our %s.'),
			sprintf(
				'<a target="_blank" href="https://wpmudev.com/docs/wpmu-dev-plugins/smartcrawl/#schema">%s</a>',
				__('Schema Documentation', 'wds')
			)
		);
		SUI.openNotice('wds-schema-types-local-business-notice', '<p>' + message + '</p>', {
			type: 'grey', icon: 'info', dismiss: {show: true}
		});
	}

	getAddSchemaModalElement() {
		return <AddSchemaTypeWizardModal
			onClose={() => this.stopAddingSchemaType()}
			onAdd={(type, label, conditions) => this.handleAddSchemaTypesButtonClick(type, label, conditions)}
		/>;
	}

	getSchemaTypeIcon(typeKey) {
		return schemaTypesList[typeKey].icon;
	}

	isProduct(type) {
		return type === 'Product' || this.isWooCommerceProduct(type);
	}

	isWooCommerceProduct(type) {
		return type === 'WooProduct'
			|| type === 'WooSimpleProduct'
			|| type === 'WooVariableProduct';
	}

	generateTypeId(type) {
		return uniqueId(type + '-');
	}

	addSchemaType(type, label, conditions) {
		const spec = {};
		const typeKey = this.generateTypeId(type);

		spec[typeKey] = {
			$set: {
				label: label,
				type: type,
				conditions: conditions,
				properties: this.getDefaultProperties(this.getPropertiesForType(type))
			}
		};

		return new Promise(resolve => {
			this.updateTypes(spec).then(() => resolve(typeKey));
		});
	}

	getType(typeKey) {
		return this.state.types[typeKey];
	}

	handleRepeatButtonClick(typeKey, propertyId) {
		this.repeatProperty(typeKey, propertyId);
		this.openAccordionItemForProperty(propertyId);

		const type = this.getType(typeKey);
		const propertyKeys = this.propertyKeys(propertyId, type.properties);
		const property = this.getPropertyByKeys(propertyKeys, type.properties);
		this.showNotice(sprintf(
			__('A new %s has been added.', 'wds'),
			property.hasOwnProperty('label_single')
				? property.label_single
				: property.label
		));
	}

	prepareRepeatableSourcePropertyKeys(propertyKeys) {
		const newKeys = [];
		propertyKeys.forEach(propertyKey => {
			if (parseInt(propertyKey) > 0) {
				// A numeric key indicates a repeatable and the source properties only have 0 as repeatable key
				newKeys.push('0');
			} else {
				newKeys.push(propertyKey);
			}
		});
		return newKeys;
	}

	repeatProperty(typeKey, propertyId) {
		const type = this.getType(typeKey);
		const propertyKeys = this.propertyKeys(propertyId, type.properties);
		const property = this.getPropertyByKeys(propertyKeys, type.properties);
		const sourcePropertyKeys = this.prepareRepeatableSourcePropertyKeys(propertyKeys);
		const sourceProperty = this.getPropertyByKeys(sourcePropertyKeys, this.getPropertiesForType(type.type));
		const repeatableKey = Object.keys(sourceProperty.properties).shift();
		const repeatable = sourceProperty.properties[repeatableKey];
		const newKey = Math.max(...Object.keys(property.properties)) + 1;

		let cloned = this.getDefaultProperty(repeatable);
		if (repeatable.disallowDeletion && repeatable.disallowFirstItemDeletionOnly) {
			delete cloned.disallowDeletion;
		}

		const spec = this.formatSpec([typeKey, 'properties', ...propertyKeys, 'properties', newKey], {
			$set: cloned
		});

		this.updateTypes(spec);
	}

	startAddingNestedProperties(typeKey, property) {
		this.openAccordionItemForProperty(property.id);

		this.setState({
			addingNestedForProperty: property.id,
		});
	}

	getTypeAccordionItemClassName(typeKey) {
		return 'wds-schema-type-' + typeKey + '-accordion';
	}

	getPropertyAccordionItemClassName(propertyId) {
		return 'wds-schema-property-' + propertyId + '-accordion';
	}

	openAccordionItemForProperty(propertyId) {
		const className = this.getPropertyAccordionItemClassName(propertyId);
		$('.' + className).addClass('sui-accordion-item--open');
	}

	nestedPropertyHasMissingRequiredProperties(typeKey, property) {
		if (
			!this.isNestedProperty(property)
			|| !property.required
			// We know that nested properties are not going to be required if the parent property itself is not required 
			// An exception to this rule is local business -> review -> author but that doesn't matter because it is inside a repeatable and is always valid
		) {
			return false;
		}

		const type = this.getType(typeKey);
		const propertyKeys = this.propertyKeys(property.id, type.properties);
		const sourceKeys = this.prepareRepeatableSourcePropertyKeys(propertyKeys);
		const sourceProperty = this.getPropertyByKeys(sourceKeys, this.getPropertiesForType(type.type));

		return this.requiredPropertiesMissing(
			property.properties,
			sourceProperty.properties
		);
	}

	getNestedPropertyElements(typeKey, property, isAnAltVersion) {
		return <tr>
			<td colSpan={4} className="wds-schema-nested-properties">
				<div className="sui-accordion">
					<div
						className={classnames('sui-accordion-item', this.getPropertyAccordionItemClassName(property.id))}>
						{this.getAccordionItemHeaderElement(
							typeKey, property,
							<React.Fragment>
								{isAnAltVersion &&
								<div className="sui-accordion-item-action">
									<button onClick={() => this.startChangingPropertyType(property.id)}
											data-tooltip={__('Change the type of this property', 'wds')}
											type="button"
											className="sui-button-icon sui-tooltip">
										<span className="sui-icon-defer" aria-hidden="true"/>
									</button>
								</div>
								}
							</React.Fragment>
						)}

						<div className="sui-accordion-item-body">
							{this.hasLoop(property) &&
							<div>{this.getLoopDescription(property)}</div>
							}

							<table className="sui-table">
								<tbody>
								{this.getPropertyElements(typeKey, property.properties)}
								</tbody>
								{!property.disallowAddition && <tfoot>
								<tr>
									<td colSpan={4}>
										<Button onClick={() => this.startAddingNestedProperties(typeKey, property)}
												ghost={true}
												icon="sui-icon-plus"
												text={__('Add Property', 'wds')}/>
									</td>
								</tr>
								</tfoot>}
							</table>
						</div>
					</div>
					{this.state.addingNestedForProperty === property.id && this.getAddNestedPropertyModalElement(typeKey, property.id)}
					{this.state.changingPropertyTypeForId === property.id && this.getPropertyTypeChangeModalElement(typeKey, property.id)}
				</div>
			</td>
		</tr>;
	}

	getRepeatingPropertyElements(typeKey, property, isAnAltVersion) {
		const repeatables = property.properties;

		return <tr>
			<td colSpan={4} className="wds-schema-repeating-properties">
				<div className="sui-accordion">
					<div
						className={classnames('sui-accordion-item', this.getPropertyAccordionItemClassName(property.id))}>
						{this.getAccordionItemHeaderElement(
							typeKey, property,
							<React.Fragment>
								{isAnAltVersion &&
								<div className="sui-accordion-item-action">
									<button onClick={() => this.startChangingPropertyType(property.id)}
											data-tooltip={__('Change the type of this property', 'wds')}
											type="button"
											className="sui-button-icon sui-tooltip">
										<span className="sui-icon-defer" aria-hidden="true"/>
									</button>
								</div>
								}

								<div className="sui-accordion-item-action">
									<button onClick={() => this.handleRepeatButtonClick(typeKey, property.id)}
											type="button"
											data-tooltip={sprintf(
												__('Add another %s', 'wds'),
												this.getSingleLabel(property)
											)}
											className="sui-button-icon sui-tooltip">
										<span className="sui-icon-plus" aria-hidden="true"/>
									</button>
								</div>
							</React.Fragment>
						)}

						<div className="sui-accordion-item-body">
							{Object.keys(repeatables).map(propertyKey => {
									const repeatable = repeatables[propertyKey];
									return <table className="sui-table">
										{repeatable.properties &&
										<thead>
										<tr>
											<td colSpan={2} className="sui-table-item-title">
												{this.getSingleLabel(property)}
											</td>
											<td>
												{!repeatable.disallowDeletion &&
												<Button text=""
														ghost={true}
														icon="sui-icon-trash"
														color="red"
														onClick={() => this.startDeletingProperty(typeKey, repeatable.id)}
												/>
												}
											</td>
										</tr>
										</thead>
										}

										<tbody>
										{repeatable.properties && this.getPropertyElements(typeKey, repeatable.properties)}
										{!repeatable.properties && this.getSimplePropertyElement(typeKey, repeatable)}
										</tbody>
									</table>;
								}
							)}
						</div>
					</div>
					{this.state.changingPropertyTypeForId === property.id && this.getPropertyTypeChangeModalElement(typeKey, property.id)}
				</div>
			</td>
		</tr>;
	}

	getLoopDescription(property) {
		if (property.loopDescription) {
			return property.loopDescription;
		}

		return sprintf(
			__('The following block will be repeated for each %s in loop', 'wds'),
			this.getSingleLabel(property)
		);
	}

	getSingleLabel(property) {
		return property.label_single ? property.label_single : property.label;
	}

	getAccordionItemHeaderElement(typeKey, property, actions) {
		const requiredNotice = property.requiredNotice
			? property.requiredNotice
			: __('This property is required by Google.', 'wds');
		const description = property.description
			? property.description
			: '';

		return <div className="sui-accordion-item-header">
			<div className="sui-accordion-item-title">
				<span className={classnames({'sui-tooltip sui-tooltip-constrained': !!description})}
					  style={{"--tooltip-width": "300px"}}
					  data-tooltip={description}>
					{property.label}
				</span>
				{property.required &&
				<span className="wds-required-asterisk sui-tooltip sui-tooltip-constrained"
					  data-tooltip={requiredNotice}>*</span>
				}
				{this.nestedPropertyHasMissingRequiredProperties(typeKey, property) &&
				<span className="sui-tooltip sui-tooltip-constrained"
					  data-tooltip={__('This section has missing properties that are required by Google.', 'wds')}>
					<span className="wds-invalid-type-icon sui-icon-warning-alert sui-md"
						  aria-hidden="true"/>
				</span>
				}
			</div>

			<div className="sui-accordion-col-auto">
				{actions}
				{!property.disallowDeletion &&
				<div className="sui-accordion-item-action wds-delete-accordion-item-action">
						<span className="sui-icon-trash"
							  onClick={() => this.startDeletingProperty(typeKey, property.id)}
							  aria-hidden="true"/>
				</div>}

				<button className="sui-button-icon sui-accordion-open-indicator"
						type="button"
						aria-label={__('Open item', 'wds')}>
					<span className="sui-icon-chevron-down" aria-hidden="true"/>
				</button>
			</div>
		</div>;
	}

	isPropertyRepeatable(property) {
		if (!this.isNestedProperty(property)) {
			return false;
		}

		const nonNumericKeys = Object.keys(property.properties).filter(key => isNaN(key));
		return nonNumericKeys.length === 0;
	}

	startResettingProperties(typeKey) {
		this.setState({
			resettingProperties: typeKey
		});
	}

	getPropertyResetModalElement(typeKey) {
		return <Modal small={true}
					  id="wds-confirm-property-reset"
					  title={__('Are you sure?', 'wds')}
					  onClose={() => this.stopResettingProperties()}
					  focusAfterOpen="wds-schema-property-reset-button"
					  description={__('Are you sure you want to dismiss your changes and turn back your properties list to default?', 'wds')}>

			<Button text={__('Cancel', 'wds')}
					onClick={() => this.stopResettingProperties()}
					ghost={true}
			/>

			<Button text={__('Reset Properties', 'wds')}
					onClick={() => this.resetProperties(typeKey)}
					icon="sui-icon-refresh"
					id="wds-schema-property-reset-button"
			/>
		</Modal>;
	}

	resetProperties(typeKey) {
		const type = this.getType(typeKey);
		const spec = this.formatSpec([typeKey, 'properties'], {
			$set: this.getDefaultProperties(this.getPropertiesForType(type.type))
		});

		this.updateTypes(spec).then(() => {
			this.showNotice(__('Properties have been reset to default', 'wds'));
			this.stopResettingProperties();
			this.checkTypeValidity(typeKey);
		});
	}

	stopResettingProperties() {
		this.setState({
			resettingProperties: ''
		});
	}

	startRenamingType(typeKey) {
		this.setState({
			renamingType: typeKey,
			newName: this.getType(typeKey).label,
		});
	}

	stopRenamingType() {
		this.setState({
			renamingType: '',
			newName: '',
		});
	}

	setNewName(name) {
		this.setState({newName: name});
	}

	renameType(typeKey) {
		if (!this.state.newName) {
			this.stopRenamingType();
			this.showNotice(__('You need to enter a name', 'wds'), 'error');

			return;
		}

		const spec = this.formatSpec([typeKey, 'label'], {
			$set: this.state.newName
		});
		this.updateTypes(spec).then(() => {
			this.showNotice(__('The type has been renamed.', 'wds'));
			this.stopRenamingType();
		});
	}

	getTypeRenameModalElement(typeKey) {
		return <Modal
			id="wds-schema-type-rename-modal"
			title={__('Rename', 'wds')}
			description={__('Leave the default type name or change it for a recognizable one.', 'wds')}
			onClose={() => this.stopRenamingType()}
			dialogClasses={{'sui-modal-sm': true}}
			focusAfterOpen="wds-schema-rename-type-input"
			onEnter={() => this.renameType(typeKey)}
			footer={
				<React.Fragment>
					<Button text={__('Cancel', 'wds')}
							onClick={() => this.stopRenamingType()}
							ghost={true}
					/>

					<Button text={__('Save', 'wds')}
							onClick={() => this.renameType(typeKey)}
							icon="sui-icon-check"
							id="wds-schema-rename-type-button"
					/>
				</React.Fragment>
			}
		>
			<div className="sui-form-field">
				<label className="sui-label">{__('New Type Name', 'wds')}</label>
				<input className="sui-form-control"
					   id="wds-schema-rename-type-input"
					   onChange={e => this.setNewName(e.target.value)}
					   value={this.state.newName}/>

				{this.isProduct(this.getType(typeKey).type) && this.isWooCommerceActive() &&
				<div className="sui-notice sui-notice-info" style={{"margin-top": "30px"}}>
					<div className="sui-notice-content">
						<div className="sui-notice-message">
							<span className="sui-notice-icon sui-icon-info sui-md" aria-hidden="true"/>
							<p>{__('On the pages where this schema type is printed, schema generated by WooCommerce will be replaced to avoid generating multiple product schemas for the same product page.', 'wds')}</p>
						</div>
					</div>
				</div>
				}
			</div>
		</Modal>;
	}

	isWooCommerceActive() {
		return !!Config_Values.get('woocommerce', 'schema_types');
	}

	startDeletingType(typeKey) {
		this.setState({
			deletingType: typeKey
		});
	}

	stopDeletingType() {
		this.setState({
			deletingType: ''
		});
	}

	deleteType(typeKey) {
		return this.updateTypes({
			$unset: [typeKey]
		});
	}

	getTypeDeleteModalElement(typeKey) {
		return <Modal small={true}
					  id="wds-confirm-type-deletion"
					  title={__('Are you sure?', 'wds')}
					  onClose={() => this.stopDeletingType()}
					  focusAfterOpen="wds-schema-type-delete-button"
					  description={__('Are you sure you wish to delete this schema type? You can add it again anytime.', 'wds')}>

			<Button text={__('Cancel', 'wds')}
					onClick={() => this.stopDeletingType()}
					ghost={true}
			/>

			<Button text={__('Delete', 'wds')}
					onClick={() => this.handleTypeDeleteButtonClick(typeKey)}
					icon="sui-icon-trash"
					color="red"
					id="wds-schema-type-delete-button"
			/>
		</Modal>;
	}

	handleTypeDeleteButtonClick(typeKey) {
		this.deleteType(typeKey).then(() => {
			this.showNotice(__('The type has been removed. You need to save the changes to make them live.', 'wds'), 'info');
			this.stopDeletingType();
			this.setTypeInvalid(typeKey, false);
		});
	}

	showNotice(message, type = 'success', dismiss = false) {
		const icons = {
			error: 'warning-alert',
			info: 'info',
			warning: 'warning-alert',
			success: 'check-tick'
		};

		SUI.openNotice('wds-schema-types-notice', '<p>' + message + '</p>', {
			type: type,
			icon: icons[type],
			dismiss: {show: dismiss}
		});
	}

	getStateInput() {
		return <input type="hidden" name="wds-schema-types" value={JSON.stringify(this.state.types)}/>;
	}

	getSaveSettingsFooter() {
		return <div id="wds-save-schema-types" className="sui-box-footer">
			<button name="submit"
					type="submit"
					className="sui-button sui-button-blue">
				<span className="sui-icon-save" aria-hidden="true"/>

				{__('Save Settings', 'wds')}
			</button>
		</div>;
	}

	startChangingPropertyType(propertyId) {
		this.setState({changingPropertyTypeForId: propertyId});
	}

	stopChangingPropertyType() {
		this.setState({changingPropertyTypeForId: 0});
	}

	getPropertyTypeChangeModalElement(typeKey, propertyId) {
		const type = this.getType(typeKey);
		const parentProperty = this.getPropertyParent(propertyId, type.properties);
		let options = this.getAltVersionTypes(parentProperty);
		if (options) {
			options = options.filter((altVersion) => {
				return parentProperty.activeVersion !== altVersion.id;
			});
		}

		return <BoxSelectorModal
			id="wds-change-property-type"
			title={__('Change Property Type', 'wds')}
			description={__('Select one of the following types to switch.', 'wds')}
			actionButtonText={__('Change', 'wds')}
			actionButtonIcon="sui-icon-defer"
			onClose={() => this.stopChangingPropertyType()}
			onAction={(selectedType) => this.handlePropertyTypeChange(typeKey, parentProperty, selectedType)}
			options={options}
			multiple={false}
		/>;
	}

	handlePropertyTypeChange(schemaTypeKey, parentProperty, selectedPropertyTypes) {
		if (!selectedPropertyTypes.length) {
			return;
		}

		const selectedPropertyType = selectedPropertyTypes[0];
		const type = this.getType(schemaTypeKey);
		const propertyKeys = this.propertyKeys(parentProperty.id, type.properties);
		const property = this.getPropertyByKeys(propertyKeys, this.getPropertiesForType(type.type));
		const versions = this.getDefaultProperties(property.properties);
		const spec = this.formatSpec([schemaTypeKey, 'properties', ...propertyKeys], {
			activeVersion: {$set: selectedPropertyType},
			properties: {$set: versions},
		});

		this.updateTypes(spec).then(() => {
			const altVersion = this.getPropertyByKeys([selectedPropertyType], versions);
			this.openAccordionItemForProperty(altVersion.id);
			this.showNotice(sprintf(__('Property type has been changed to %s', 'wds'), selectedPropertyType));
			this.checkTypeValidity(schemaTypeKey);
		});
	}

	getPropertyParent(childId, properties) {
		const propertyKeys = this.propertyKeys(childId, properties);
		propertyKeys.pop(); // child key
		propertyKeys.pop(); // 'properties'
		return this.getPropertyByKeys(propertyKeys, properties);
	}

	getPropertyById(propertyId, properties) {
		const propertyKeys = this.propertyKeys(propertyId, properties);
		return this.getPropertyByKeys(propertyKeys, properties);
	}

	getAltVersionTypes(property) {
		if (!this.hasAltVersions(property)) {
			return false;
		}

		const types = [];
		Object.keys(property.properties).forEach((type) => {
			const altVersion = property.properties[type];

			types.push({
				id: type,
				label: altVersion.label
			});
		});

		return types;
	}

	duplicateType(typeKey) {
		const spec = {};
		const type = this.getType(typeKey);
		const typeId = this.generateTypeId(type.type);
		const properties = this.cloneProperties(type.properties);
		const conditions = this.cloneConditions(type.conditions);

		spec[typeId] = {
			$set: {
				label: type.label,
				type: type.type,
				conditions: conditions,
				properties: properties
			}
		};

		this.updateTypes(spec).then(() => {
			this.checkTypeValidity(typeId);
			this.showNotice(__('The type has been duplicated successfully.', 'wds'));
		});
	}

	removeAddTypeQueryVar() {
		const searchParams = location.search;
		const params = new URLSearchParams(searchParams);
		if (!params.get('add_type')) {
			return;
		}

		params.delete('add_type');
		const newURL = location.href.replace(searchParams, '?' + params.toString());

		history.replaceState({}, "", newURL);
	}

	maybeStartAddingSchemaType() {
		const searchParams = location.search;
		const params = new URLSearchParams(searchParams);
		if (params.get('add_type') === '1') {
			this.startAddingSchemaType();
		}
	}

	getNextTypesNotice() {
		return <div className="sui-notice sui-notice-info">
			<div className="sui-notice-content">
				<div className="sui-notice-message">
					<span className="sui-notice-icon sui-icon-info sui-md" aria-hidden="true"/>
					<p>{createInterpolateElement(__('<strong>New schema types coming soon!</strong> These will help search engines better understand your content and increase your visibility in search engine results. Vote for the next types you would like to be added.', 'wds'), {
						'strong': <strong/>
					})}</p>
					<p>
						<a href="https://docs.google.com/forms/d/e/1FAIpQLSeXoUd8-xBv0x6E391VmPsV1hr428Ps7VmWueUFaFxRtJugYg/viewform"
						   target="_blank"
						   className="sui-button sui-button-ghost">
							{__('Vote for the Next Types', 'wds')}
						</a>
					</p>
					<p/>
				</div>
			</div>
		</div>
	}
}

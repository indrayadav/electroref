import React from 'react';
import schemaTypesHierarchy from "./schema-types-hierarchy";
import {first, last, uniqueId} from "lodash-es";
import Modal from "./modal";
import {__, sprintf} from "@wordpress/i18n";
import BoxSelector from "./box-selector";
import Button from "./button";
import schemaTypes from "./schema-types";
import SchemaTypeCondition from "./schema-type-condition";
import cloneDeep from "lodash-es/cloneDeep";
import {createInterpolateElement} from '@wordpress/element';

export default class AddSchemaTypeWizardModal extends React.Component {
	static defaultProps = {
		onClose: () => false,
		onAdd: () => false,
	};

	constructor(props) {
		super(props);

		this.MODAL_STATE = {
			TYPE: 'type',
			LABEL: 'label',
			CONDITION: 'condition',
		};

		this.state = {
			modalState: this.MODAL_STATE.TYPE,
			selectedTypes: [],
			addedTypes: [],
			typeLabel: '',
			searchTerm: '',
			typeConditions: []
		};
	}

	switchModalState(newModalState) {
		this.setState({
			modalState: newModalState
		});
	}

	isStateType() {
		return this.state.modalState === this.MODAL_STATE.TYPE;
	}

	isStateLabel() {
		return this.state.modalState === this.MODAL_STATE.LABEL;
	}

	isStateCondition() {
		return this.state.modalState === this.MODAL_STATE.CONDITION;
	}

	switchToType() {
		this.switchModalState(this.MODAL_STATE.TYPE);
	}

	switchToLabel() {
		this.switchModalState(this.MODAL_STATE.LABEL);
	}

	switchToCondition() {
		this.switchModalState(this.MODAL_STATE.CONDITION);
	}

	clearSearchTerm() {
		this.setState({
			searchTerm: ''
		});
	}

	setSearchTerm(searchTerm) {
		this.setState({
			searchTerm: searchTerm
		});
	}

	handleNextButtonClick() {
		if (this.isStateType()) {
			if (this.hasSubTypeOptions()) {
				this.loadSubTypes();
			} else {
				this.setNewLabel(this.getDefaultTypeLabel());
				this.switchToLabel();
			}
		} else if (this.isStateLabel()) {
			this.setDefaultCondition(this.getTypeToAdd());
			this.switchToCondition();
		} else {
			this.addType();
		}
	}

	handleBackButtonClick() {
		this.clearSearchTerm();
		if (this.isStateType()) {
			if (this.typesAdded()) {
				this.loadPreviousTypes();
			} else {
				this.props.onClose();
			}
		} else if (this.isStateLabel()) {
			this.switchToType();
		} else {
			this.switchToLabel();
		}
	}

	getTypeToAdd() {
		let selected = false;
		if (this.state.selectedTypes.length) {
			selected = first(this.state.selectedTypes);
		} else if (this.typesAdded()) {
			selected = last(this.state.addedTypes);
		}

		return selected;
	}

	addType() {
		const defaultValue = this.getDefaultTypeLabel();

		this.props.onAdd(
			this.getTypeToAdd(),
			this.state.typeLabel.trim() || defaultValue,
			this.state.typeConditions
		);
	}

	loadSubTypes() {
		const selectedTypes = this.state.selectedTypes;
		const addedTypes = this.state.addedTypes.slice();

		addedTypes.push(
			first(selectedTypes)
		);

		this.setState({
			selectedTypes: [],
			addedTypes: addedTypes
		});
	}

	hasSubTypeOptions() {
		const selectedTypes = this.state.selectedTypes;
		if (!selectedTypes.length) {
			return false;
		}

		const addedTypes = this.state.addedTypes.slice();
		addedTypes.push(first(selectedTypes));

		return !!this.getSubTypes(addedTypes);
	}

	loadPreviousTypes() {
		const addedTypes = this.state.addedTypes.slice();
		const popped = addedTypes.pop();

		this.setState({
			selectedTypes: [popped],
			addedTypes: addedTypes
		});
	}

	getOptions() {
		const addedTypes = this.state.addedTypes;
		let types = this.getSubTypes(addedTypes);
		if (!types) {
			return [];
		} else {
			return this.buildOptionsFromTypes(types);
		}
	}

	getSubTypes(typesPath) {
		let types = schemaTypesHierarchy;

		typesPath.forEach((pathType) => {
			if (types && types.hasOwnProperty(pathType)) {
				types = types[pathType];
			} else {
				types = false;
			}
		});

		return types;
	}

	buildOptionsFromTypes(types) {
		const options = [];
		Object.keys(types).forEach((type) => {
			if (
				schemaTypes.hasOwnProperty(type)
				&& (this.state.searchTerm.trim() === '' || this.typeOrSubtypeMatchesSearch(type))
			) {
				options.push({
					id: type,
					label: schemaTypes[type].label,
					icon: schemaTypes[type].icon,
					disabled: !!schemaTypes[type].disabled
				});
			}
		});
		return options;
	}

	getTypeSection() {
		const options = this.getOptions();

		return <React.Fragment>
			{this.breadcrumbs()}

			{this.typesAdded() &&
			<div id="wds-search-sub-types">
				<div className="sui-control-with-icon">
					<span className="sui-icon-magnifying-glass-search"
						  aria-hidden="true"/>
					<input type="text"
						   placeholder={__('Search subtypes', 'wds')}
						   className="sui-form-control"
						   value={this.state.searchTerm}
						   onChange={e => this.setSearchTerm(e.target.value)}/>
				</div>
			</div>
			}

			<BoxSelector id="wds-add-schema-type-selector"
						 options={options}
						 selectedValues={this.state.selectedTypes}
						 multiple={false}
						 onChange={(items) => this.handleSelection(items)}
			/>

			{!this.typesAdded() &&
			<div className="wds-box-selector-message">
				<h3>{__('Coming Next', 'wds')}</h3>
				<p className="sui-description">{__('Heaps more schema types like Courses, Books, Job Postings and others coming soon.', 'wds')}</p>
			</div>
			}

		</React.Fragment>;
	}

	setNewLabel(label) {
		this.setState({
			typeLabel: label
		});
	}

	getLabelSection() {
		const placeholder = this.getDefaultTypeLabel();

		return <div id="wds-add-schema-type-label">
			<div className="sui-form-field">
				<label className="sui-label">
					{__('Type Name', 'wds')}
				</label>

				<input className="sui-form-control"
					   onChange={e => this.setNewLabel(e.target.value)}
					   placeholder={placeholder}
					   value={this.state.typeLabel}/>
			</div>
		</div>;
	}

	handleSelection(selectedTypes) {
		this.setState({selectedTypes: selectedTypes});
	}

	getSubTypesNotice(type) {
		if (!schemaTypes.hasOwnProperty(type)) {
			return '';
		}

		return schemaTypes[type].subTypesNotice || '';
	}

	getTypeLabel(type) {
		if (!schemaTypes.hasOwnProperty(type)) {
			return type;
		}

		return schemaTypes[type].label;
	}

	breadcrumbs() {
		const types = this.state.addedTypes.slice();
		const selectedTypes = this.state.selectedTypes;

		if (selectedTypes.length) {
			types.push(first(selectedTypes));
		}

		if (types.length) {
			return <div id="wds-add-schema-type-breadcrumbs">
				{types.map((type) => <span>{this.getTypeLabel(type)} <span className="sui-icon-chevron-right"
																		   aria-hidden="true"/></span>)}
			</div>;
		}
	}

	isNextButtonDisabled() {
		if (this.isStateType()) {
			return !this.state.selectedTypes.length
				&& !this.typesAdded();
		} else {
			return false;
		}
	}

	typesAdded() {
		return !!this.state.addedTypes.length;
	}

	getModalTitle() {
		if (this.isStateType() && this.typesAdded()) {
			return <React.Fragment>
				<span className="sui-tag sui-tag-sm sui-tag-blue">{__('Optional', 'wds')}</span>
				<br/>
				{__('Select Sub Type', 'wds')}
			</React.Fragment>;
		} else {
			return __('Add Schema Type', 'wds')
		}
	}

	getModalDescription() {
		if (this.isStateType()) {
			if (this.typesAdded()) {
				const selected = last(this.state.addedTypes);
				let subTypesDescription = sprintf(
					__('You can specify a subtype of %s, or you can skip this to add the generic type.', 'wds'),
					this.getTypeLabel(selected)
				);
				subTypesDescription += '<br/>' + this.getSubTypesNotice(selected);
				return createInterpolateElement(subTypesDescription, {
					br: <br/>,
					strong: <strong/>
				});
			} else {
				return __('Start by selecting the schema type you want to use. By default, all of the types will include the properties required and recommended by Google.', 'wds');
			}
		} else if (this.isStateLabel()) {
			return sprintf(
				__('Name your %s type so you can easily identify it.', 'wds'),
				this.getDefaultTypeLabel()
			);
		} else {
			return __('Create a set of rules to determine where this schema type will be enabled or excluded.', 'wds');
		}
	}

	getDefaultTypeLabel() {
		return this.getTypeLabel(this.getTypeToAdd());
	}

	getConditionSection() {
		const conditions = this.state.typeConditions;
		const typeKey = this.getTypeToAdd();

		return <div id="wds-add-schema-type-conditions">
			{this.getConditionGroupElements(typeKey, conditions)}

			<Button text={__('Add Rule (Or)', 'wds')}
					ghost={true}
					onClick={() => this.addGroup(typeKey)}
					icon="sui-icon-plus"/>
		</div>;
	}

	addGroup(typeKey) {
		const updatedConditions = cloneDeep(this.state.typeConditions);
		updatedConditions.push([this.getDefaultCondition(typeKey)]);

		this.setState({
			typeConditions: updatedConditions
		});
	}

	setDefaultCondition(type) {
		const defaultCondition = this.getDefaultCondition(type);

		this.setState({
			typeConditions: [[defaultCondition]]
		});
	}

	getDefaultCondition(type) {
		const schemaTypeDefinition = schemaTypes[type];
		const fallback = {id: uniqueId(), lhs: 'post_type', operator: '=', rhs: 'post'};

		let condition = false;
		if (schemaTypeDefinition.condition) {
			condition = schemaTypeDefinition.condition;
		} else if (
			schemaTypeDefinition.parent
			&& schemaTypes[schemaTypeDefinition.parent].condition
		) {
			condition = schemaTypes[schemaTypeDefinition.parent].condition
		}

		return condition
			? Object.assign({}, condition, {id: uniqueId()})
			: fallback;
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
				onChange={(id, lhs, operator, rhs) => this.updateCondition(id, lhs, operator, rhs)}
				onAdd={(id) => this.addCondition(typeKey, id)}
				onDelete={(id) => this.deleteCondition(id)}
				disableDelete={conditionGroupIndex === 0 && conditionIndex === 0}
				key={condition.id} id={condition.id}
				lhs={condition.lhs} operator={condition.operator}
				rhs={condition.rhs}/>
		);
	}

	updateCondition(id, lhs, operator, rhs) {
		const updatedConditions = cloneDeep(this.state.typeConditions);
		const groupIndex = this.conditionGroupIndex(updatedConditions, id);
		const conditionIndex = this.conditionIndex(updatedConditions[groupIndex], id);

		updatedConditions[groupIndex][conditionIndex].lhs = lhs;
		updatedConditions[groupIndex][conditionIndex].operator = operator;
		updatedConditions[groupIndex][conditionIndex].rhs = rhs;

		this.setState({
			typeConditions: updatedConditions
		});
	}

	addCondition(typeKey, id) {
		const updatedConditions = cloneDeep(this.state.typeConditions);
		const groupIndex = this.conditionGroupIndex(updatedConditions, id);
		const conditionIndex = this.conditionIndex(updatedConditions[groupIndex], id);
		const newConditionIndex = conditionIndex + 1;
		const defaultCondition = this.getDefaultCondition(typeKey);

		updatedConditions[groupIndex].splice(newConditionIndex, 0, defaultCondition);

		this.setState({
			typeConditions: updatedConditions
		});
	}

	deleteCondition(id) {
		const updatedConditions = cloneDeep(this.state.typeConditions);
		const groupIndex = this.conditionGroupIndex(updatedConditions, id);
		const group = updatedConditions[groupIndex];
		if (group.length === 1) {
			updatedConditions.splice(groupIndex, 1);
		} else {
			const conditionIndex = this.conditionIndex(group, id);
			updatedConditions[groupIndex].splice(conditionIndex, 1);
		}

		this.setState({
			typeConditions: updatedConditions
		});
	}

	conditionGroupIndex(conditions, id) {
		return conditions.findIndex(conditions => this.conditionIndex(conditions, id) > -1);
	}

	conditionIndex(conditions, id) {
		return conditions.findIndex(condition => condition.id === id);
	}

	stringIncludesSubstring(string, subString) {
		return string.toLowerCase().includes(subString.toLowerCase());
	}

	typeMatchesSearch(type) {
		const typeMatches = this.stringIncludesSubstring(type, this.state.searchTerm);
		if (typeMatches) {
			return true;
		}

		return this.stringIncludesSubstring(this.getTypeLabel(type), this.state.searchTerm);
	}

	typeOrSubtypeMatchesSearch(type) {
		if (this.typeMatchesSearch(type)) {
			return true;
		}

		const addedTypes = this.state.addedTypes.slice();
		addedTypes.push(type);
		const subTypes = this.getSubTypes(addedTypes);

		if (!subTypes) {
			return false;
		} else {
			let subtypeMatched = false;
			Object.keys(subTypes).forEach(subType => {
				if (this.typeMatchesSearch(subType)) {
					subtypeMatched = true;
				}
			});

			return subtypeMatched;
		}
	}

	render() {
		return <Modal id="wds-add-schema-type-modal"
					  title={this.getModalTitle()}
					  onClose={() => this.props.onClose()}
					  small={true}
					  dialogClasses={{
						  'sui-modal-lg': true,
						  'sui-modal-sm': false
					  }}
					  description={this.getModalDescription()}>

			{this.isStateType() && this.getTypeSection()}
			{this.isStateLabel() && this.getLabelSection()}
			{this.isStateCondition() && this.getConditionSection()}

			<div style={{
				"display": "flex",
				"justify-content": "space-between"
			}}>
				<Button text={__('Back', 'wds')}
						icon="sui-icon-arrow-left"
						id="wds-add-schema-type-back-button"
						onClick={() => this.handleBackButtonClick()}
						ghost={true}
				/>

				{!this.isStateCondition() &&
				<Button text={__('Continue', 'wds')}
						icon="sui-icon-arrow-right"
						id="wds-add-schema-type-action-button"
						onClick={() => this.handleNextButtonClick()}
						disabled={this.isNextButtonDisabled()}
				/>
				}

				{this.isStateCondition() &&
				<Button text={__('Add', 'wds')}
						icon="sui-icon-plus"
						id="wds-add-schema-type-action-button"
						color="blue"
						onClick={() => this.handleNextButtonClick()}
				/>
				}
			</div>
		</Modal>
	}
}

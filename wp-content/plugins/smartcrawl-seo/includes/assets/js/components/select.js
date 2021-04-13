import React from 'react';
import $ from 'jQuery';

export default class Select extends React.Component {
	static defaultProps = {
		small: false,
		tagging: false,
		placeholder: '',
		ajaxUrl: '',
		getSingleAjaxUrl: '',
		selectedValue: '',
		minimumResultsForSearch: 10,
		minimumInputLength: 3,
		multiple: false,
		options: {},
		onSelect: () => false,
	};

	constructor(props) {
		super(props);

		this.props = props;
		this.state = {
			loadingText: false
		};
		this.selectElement = React.createRef();
		this.selectElementContainer = React.createRef();
	}

	componentDidMount() {
		const $select = $(this.selectElement.current);
		$select
			.addClass(this.props.small ? 'sui-select sui-select-sm' : 'sui-select')
			.SUIselect2(this.getSelect2Args());

		this.includeSelectedValueAsDynamicOption();

		$select.on('change', (e) => this.handleChange(e));
	}

	includeSelectedValueAsDynamicOption() {
		if (this.props.selectedValue && this.noOptionsAvailable()) {
			if (this.props.tagging) {
				this.addOption(this.props.selectedValue, this.props.selectedValue, true);
			} else if (this.props.getSingleAjaxUrl) {
				this.loadTextFromRemote();
			}
		}
	}

	loadTextFromRemote() {
		if (this.state.loadingText) {
			// Already in the middle of a remote call
			return;
		}

		this.setState({loadingText: true});

		$.get(this.props.getSingleAjaxUrl, {
			'id': this.props.selectedValue
		}).done((data) => {
			if (data && data.results && data.results.length) {
				const result = data.results.shift();
				this.addOption(result.id, result.text, true);
			}

			this.setState({loadingText: false});
		});
	}

	addOption(value, text, selected) {
		let newOption = new Option(text, value, false, selected);
		$(this.selectElement.current).append(newOption).trigger('change');
	}

	noOptionsAvailable() {
		return !Object.keys(this.props.options).length;
	}

	componentWillUnmount() {
		const $select = $(this.selectElement.current);
		$select.off().SUIselect2('destroy');
	}

	getSelect2Args() {
		const $container = $(this.selectElementContainer.current);

		let args = {
			dropdownParent: $container,
			dropdownCssClass: 'sui-select-dropdown',
			minimumResultsForSearch: this.props.minimumResultsForSearch,
			multiple: this.props.multiple,
			tagging: this.props.tagging
		};

		if (this.props.placeholder) {
			args['placeholder'] = this.props.placeholder;
		}

		if (this.props.ajaxUrl) {
			args['ajax'] = {url: this.props.ajaxUrl};
			args['minimumInputLength'] = this.props.minimumInputLength;
		}

		if (this.props.ajaxUrl && this.props.tagging) {
			args['ajax']['processResults'] = (response, request) => {
				if (response.results && !response.results.length) {
					return {
						results: [{
							id: request.term,
							text: request.term
						}]
					}
				}

				return response;
			};
		}

		return args;
	}

	handleChange(e) {
		let value = e.target.value;
		if (this.props.multiple) {
			value = Array.from(e.target.selectedOptions, option => option.value);
		}

		this.props.onSelect(value);
	}

	isValueSelected(key) {
		if (this.props.multiple && Array.isArray(this.props.selectedValue)) {
			return this.props.selectedValue.includes(key);
		} else {
			return this.props.selectedValue === key;
		}
	}

	render() {
		const optionsProp = this.props.options;
		let options;
		if (Object.keys(optionsProp).length) {
			options = Object.keys(optionsProp).map((key) =>
				<option key={key}
						selected={this.isValueSelected(key)}
						value={key}>

					{optionsProp[key]}
				</option>
			);
		} else {
			options = <option/>;
		}

		return <div ref={this.selectElementContainer}>
			<select disabled={this.state.loadingText}
					ref={this.selectElement}
					multiple={this.props.multiple}>{options}</select>
		</div>;
	}
}

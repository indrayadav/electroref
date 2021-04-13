import React from 'react';

export default class Text extends React.Component {
	static defaultProps = {
		placeholder: '',
		value: '',
		onChange: () => false
	}

	constructor(props) {
		super(props);

		this.props = props;
	}

	handleChange(e) {
		e.target.style.height = 0;

		const scrollHeight = e.target.scrollHeight;
		e.target.style.height = (scrollHeight < 30 ? 30 : scrollHeight) + 'px';

		this.props.onChange(e.target.value);
	}

	render() {
		return <textarea placeholder={this.props.placeholder}
						 value={this.props.value}
						 onChange={e => this.handleChange(e)}/>
	}
}

import React from 'react';
import {__} from '@wordpress/i18n';

export default class Dropdown extends React.Component {
	handleClick(e, id) {
		e.preventDefault();
		e.stopPropagation();

		this.props.onClick(id);
	}

	render() {
		return <div className="sui-dropdown sui-accordion-item-action">
			<button className="sui-button-icon sui-dropdown-anchor" aria-label={__('Dropdown', 'wds')}>
				<span className="sui-icon-widget-settings-config" aria-hidden="true"/>
			</button>

			<ul>
				{this.props.buttons.map(button => <li>{button}</li>)}
			</ul>
		</div>;
	}
}

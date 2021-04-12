import React from 'react';
import {render} from 'react-dom';
import SchemaBuilder from "./components/schema-builder";
import ErrorBoundary from "./components/error-boundry";
import $ from 'jQuery';

$(document).ready(() => {
	render(
		<ErrorBoundary><SchemaBuilder/></ErrorBoundary>,
		document.getElementById('wds-schema-type-components')
	);
});

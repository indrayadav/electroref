import wp from 'wp';

if (((wp || {}).blockEditor || {}).__experimentalLinkControl) {
	import('./link-format-button').then(({link}) => {

		const {registerFormatType, unregisterFormatType} = wp.richText;
		[link].forEach(({name, ...settings}) => {
			unregisterFormatType(name);
			registerFormatType(name, settings);
		});

	});
} else {
	console.log('SmartCrawl: wp.blockEditor.__experimentalLinkControl not found');
}

import DateTime from "./date-time";
import Email from "./email";
import ImageObject from "./image-object";
import ImageURL from "./image-url";
import Phone from "./phone";
import Text from './text-basic';
import TextFull from "./text-full";
import URL from "./url";
import Array from "./array";
import Number from "./number";

const schemaSources = {
	DateTime: DateTime,
	Email: Email,
	ImageObject: ImageObject,
	ImageURL: ImageURL,
	Phone: Phone,
	Text: Text,
	TextFull: TextFull,
	URL: URL,
	Array: Array,
	Number: Number,
};

export default schemaSources;

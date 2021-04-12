import uniqueId from "lodash-es/uniqueId";
import {__} from "@wordpress/i18n";
import Config_Values from "../es6/config-values";

const id = uniqueId;

export default {
	Article: {
		label: __('Article', 'wds'),
		icon: 'sui-icon-page',
	},
	BlogPosting: {
		label: __('Blog Posting', 'wds'),
		icon: 'wds-custom-icon-blog',
		parent: 'Article',
	},
	NewsArticle: {
		label: __('News Article', 'wds'),
		icon: 'wds-custom-icon-newspaper',
		parent: 'Article',
	},
	Event: {
		label: __('Event', 'wds'),
		icon: 'wds-custom-icon-calendar-check',
	},
	FAQPage: {
		label: __('FAQ Page', 'wds'),
		icon: 'wds-custom-icon-question-circle',
	},
	HowTo: {
		label: __('How To', 'wds'),
		icon: 'wds-custom-icon-list-alt',
	},
	LocalBusiness: {
		label: __("Local Business", "wds"),
		icon: "wds-custom-icon-store",
		condition: {id: id(), lhs: 'homepage', operator: '=', rhs: ''},
	},
	AnimalShelter: {
		label: __("Animal Shelter", "wds"),
		icon: "wds-custom-icon-paw",
		parent: "LocalBusiness"
	},
	AutomotiveBusiness: {
		label: __("Automotive Business", "wds"),
		icon: "wds-custom-icon-car",
		parent: "LocalBusiness"
	},
	AutoBodyShop: {
		label: __("Auto Body Shop", "wds"),
		icon: "wds-custom-icon-car-building",
		parent: "LocalBusiness"
	},
	AutoDealer: {
		label: __("Auto Dealer", "wds"),
		icon: "wds-custom-icon-car-garage",
		parent: "LocalBusiness"
	},
	AutoPartsStore: {
		label: __("Auto Parts Store", "wds"),
		icon: "wds-custom-icon-tire",
		parent: "LocalBusiness"
	},
	AutoRental: {
		label: __("Auto Rental", "wds"),
		icon: "wds-custom-icon-garage-car",
		parent: "LocalBusiness"
	},
	AutoRepair: {
		label: __("Auto Repair", "wds"),
		icon: "wds-custom-icon-car-mechanic",
		parent: "LocalBusiness"
	},
	AutoWash: {
		label: __("Auto Wash", "wds"),
		icon: "wds-custom-icon-car-wash",
		parent: "LocalBusiness"
	},
	GasStation: {
		label: __("Gas Station", "wds"),
		icon: "wds-custom-icon-gas-pump",
		parent: "LocalBusiness"
	},
	MotorcycleDealer: {
		label: __("Motorcycle Dealer", "wds"),
		icon: "wds-custom-icon-motorcycle",
		parent: "LocalBusiness"
	},
	MotorcycleRepair: {
		label: __("Motorcycle Repair", "wds"),
		icon: "wds-custom-icon-tools",
		parent: "LocalBusiness"
	},
	ChildCare: {
		label: __("Child Care", "wds"),
		icon: "wds-custom-icon-baby",
		parent: "LocalBusiness"
	},
	DryCleaningOrLaundry: {
		label: __("Dry Cleaning Or Laundry", "wds"),
		icon: "wds-custom-icon-washer",
		parent: "LocalBusiness"
	},
	EmergencyService: {
		label: __("Emergency Service", "wds"),
		icon: "wds-custom-icon-siren-on",
		parent: "LocalBusiness"
	},
	FireStation: {
		label: __("Fire Station", "wds"),
		icon: "wds-custom-icon-fire-extinguisher",
		parent: "LocalBusiness"
	},
	Hospital: {
		label: __("Hospital", "wds"),
		icon: "wds-custom-icon-hospital-alt",
		parent: "LocalBusiness"
	},
	PoliceStation: {
		label: __("Police Station", "wds"),
		icon: "wds-custom-icon-police-box",
		parent: "LocalBusiness"
	},
	EmploymentAgency: {
		label: __("Employment Agency", "wds"),
		icon: "wds-custom-icon-user-tie",
		parent: "LocalBusiness"
	},
	EntertainmentBusiness: {
		label: __("Entertainment Business", "wds"),
		icon: "wds-custom-icon-tv-music",
		parent: "LocalBusiness"
	},
	AdultEntertainment: {
		label: __("Adult Entertainment", "wds"),
		icon: "wds-custom-icon-diamond",
		parent: "LocalBusiness"
	},
	AmusementPark: {
		label: __("Amusement Park", "wds"),
		icon: "wds-custom-icon-helicopter",
		parent: "LocalBusiness"
	},
	ArtGallery: {
		label: __("Art Gallery", "wds"),
		icon: "wds-custom-icon-image",
		parent: "LocalBusiness"
	},
	Casino: {
		label: __("Casino", "wds"),
		icon: "wds-custom-icon-coins",
		parent: "LocalBusiness"
	},
	ComedyClub: {
		label: __("Comedy Club", "wds"),
		icon: "wds-custom-icon-theater-masks",
		parent: "LocalBusiness"
	},
	MovieTheater: {
		label: __("Movie Theater", "wds"),
		icon: "wds-custom-icon-camera-movie",
		parent: "LocalBusiness"
	},
	NightClub: {
		label: __("Night Club", "wds"),
		icon: "wds-custom-icon-cocktail",
		parent: "LocalBusiness"
	},
	FinancialService: {
		label: __("Financial Service", "wds"),
		icon: "wds-custom-icon-briefcase",
		parent: "LocalBusiness"
	},
	AccountingService: {
		label: __("Accounting Service", "wds"),
		icon: "wds-custom-icon-cabinet-filing",
		parent: "LocalBusiness"
	},
	AutomatedTeller: {
		label: __("Automated Teller", "wds"),
		icon: "wds-custom-icon-credit-card",
		parent: "LocalBusiness"
	},
	BankOrCreditUnion: {
		label: __("Bank Or Credit Union", "wds"),
		icon: "wds-custom-icon-landmark",
		parent: "LocalBusiness"
	},
	InsuranceAgency: {
		label: __("Insurance Agency", "wds"),
		icon: "wds-custom-icon-car-crash",
		parent: "LocalBusiness"
	},
	FoodEstablishment: {
		label: __("Food Establishment", "wds"),
		icon: "wds-custom-icon-carrot",
		condition: {id: id(), lhs: 'homepage', operator: '=', rhs: ''},
	},
	Bakery: {
		label: __("Bakery", "wds"),
		icon: "wds-custom-icon-croissant",
		parent: "FoodEstablishment"
	},
	BarOrPub: {
		label: __("Bar Or Pub", "wds"),
		icon: "wds-custom-icon-glass-whiskey-rocks",
		parent: "FoodEstablishment"
	},
	Brewery: {
		label: __("Brewery", "wds"),
		icon: "wds-custom-icon-beer",
		parent: "FoodEstablishment"
	},
	CafeOrCoffeeShop: {
		label: __("Cafe Or Coffee Shop", "wds"),
		icon: "wds-custom-icon-coffee",
		parent: "FoodEstablishment"
	},
	Distillery: {
		label: __("Distillery", "wds"),
		icon: "wds-custom-icon-flask-potion",
		parent: "FoodEstablishment"
	},
	FastFoodRestaurant: {
		label: __("Fast Food Restaurant", "wds"),
		icon: "wds-custom-icon-burger-soda",
		parent: "FoodEstablishment"
	},
	IceCreamShop: {
		label: __("Ice Cream Shop", "wds"),
		icon: "wds-custom-icon-ice-cream",
		parent: "FoodEstablishment"
	},
	Restaurant: {
		label: __("Restaurant", "wds"),
		icon: "wds-custom-icon-utensils-alt",
		parent: "FoodEstablishment"
	},
	Winery: {
		label: __("Winery", "wds"),
		icon: "wds-custom-icon-wine-glass-alt",
		parent: "FoodEstablishment"
	},
	GovernmentOffice: {
		label: __("Government Office", "wds"),
		icon: "wds-custom-icon-university",
		parent: "LocalBusiness"
	},
	PostOffice: {
		label: __("Post Office", "wds"),
		icon: "wds-custom-icon-mailbox",
		parent: "LocalBusiness"
	},
	HealthAndBeautyBusiness: {
		label: __("Health And Beauty Business", "wds"),
		icon: "wds-custom-icon-heartbeat",
		parent: "LocalBusiness"
	},
	BeautySalon: {
		label: __("Beauty Salon", "wds"),
		icon: "wds-custom-icon-lips",
		parent: "LocalBusiness"
	},
	DaySpa: {
		label: __("Day Spa", "wds"),
		icon: "wds-custom-icon-spa",
		parent: "LocalBusiness"
	},
	HairSalon: {
		label: __("Hair Salon", "wds"),
		icon: "wds-custom-icon-cut",
		parent: "LocalBusiness"
	},
	HealthClub: {
		label: __("Health Club", "wds"),
		icon: "wds-custom-icon-notes-medical",
		parent: "LocalBusiness"
	},
	NailSalon: {
		label: __("Nail Salon", "wds"),
		icon: "wds-custom-icon-hands-heart",
		parent: "LocalBusiness"
	},
	TattooParlor: {
		label: __("Tattoo Parlor", "wds"),
		icon: "wds-custom-icon-moon-stars",
		parent: "LocalBusiness"
	},
	HomeAndConstructionBusiness: {
		label: __("Home And Construction Business", "wds"),
		icon: "wds-custom-icon-home-heart",
		parent: "LocalBusiness"
	},
	Electrician: {
		label: __("Electrician", "wds"),
		icon: "wds-custom-icon-bolt",
		parent: "LocalBusiness"
	},
	GeneralContractor: {
		label: __("General Contractor", "wds"),
		icon: "wds-custom-icon-house-leave",
		parent: "LocalBusiness"
	},
	HVACBusiness: {
		label: __("HVACBusiness", "wds"),
		icon: "wds-custom-icon-temperature-frigid",
		parent: "LocalBusiness"
	},
	HousePainter: {
		label: __("House Painter", "wds"),
		icon: "wds-custom-icon-paint-roller",
		parent: "LocalBusiness"
	},
	Locksmith: {
		label: __("Locksmith", "wds"),
		icon: "wds-custom-icon-key",
		parent: "LocalBusiness"
	},
	MovingCompany: {
		label: __("Moving Company", "wds"),
		icon: "wds-custom-icon-dolly",
		parent: "LocalBusiness"
	},
	Plumber: {
		label: __("Plumber", "wds"),
		icon: "wds-custom-icon-faucet",
		parent: "LocalBusiness"
	},
	RoofingContractor: {
		label: __("Roofing Contractor", "wds"),
		icon: "wds-custom-icon-home",
		parent: "LocalBusiness"
	},
	InternetCafe: {
		label: __("Internet Cafe", "wds"),
		icon: "wds-custom-icon-mug-hot",
		parent: "LocalBusiness"
	},
	LegalService: {
		label: __("Legal Service", "wds"),
		icon: "wds-custom-icon-balance-scale-right",
		parent: "LocalBusiness"
	},
	Attorney: {
		label: __("Attorney", "wds"),
		icon: "wds-custom-icon-gavel",
		parent: "LocalBusiness"
	},
	Notary: {
		label: __("Notary", "wds"),
		icon: "wds-custom-icon-pen-alt",
		parent: "LocalBusiness"
	},
	Library: {
		label: __("Library", "wds"),
		icon: "wds-custom-icon-books",
		parent: "LocalBusiness"
	},
	LodgingBusiness: {
		label: __("Lodging Business", "wds"),
		icon: "wds-custom-icon-bed",
		parent: "LocalBusiness"
	},
	BedAndBreakfast: {
		label: __("Bed And Breakfast", "wds"),
		icon: "wds-custom-icon-bed-empty",
		parent: "LocalBusiness"
	},
	Campground: {
		label: __("Campground", "wds"),
		icon: "wds-custom-icon-campground",
		parent: "LocalBusiness"
	},
	Hostel: {
		label: __("Hostel", "wds"),
		icon: "wds-custom-icon-bed-bunk",
		parent: "LocalBusiness"
	},
	Hotel: {
		label: __("Hotel", "wds"),
		icon: "wds-custom-icon-h-square",
		parent: "LocalBusiness"
	},
	Motel: {
		label: __("Motel", "wds"),
		icon: "wds-custom-icon-concierge-bell",
		parent: "LocalBusiness"
	},
	Resort: {
		label: __("Resort", "wds"),
		icon: "wds-custom-icon-umbrella-beach",
		parent: "LocalBusiness"
	},
	MedicalBusiness: {
		label: __("Medical Business", "wds"),
		icon: "wds-custom-icon-clinic-medical",
		parent: "LocalBusiness"
	},
	CommunityHealth: {
		label: __("Community Health", "wds"),
		icon: "wds-custom-icon-hospital-user",
		parent: "LocalBusiness"
	},
	Dentist: {
		label: __("Dentist", "wds"),
		icon: "wds-custom-icon-tooth",
		parent: "LocalBusiness"
	},
	Dermatology: {
		label: __("Dermatology", "wds"),
		icon: "wds-custom-icon-allergies",
		parent: "LocalBusiness"
	},
	DietNutrition: {
		label: __("Diet Nutrition", "wds"),
		icon: "wds-custom-icon-weight",
		parent: "LocalBusiness"
	},
	Emergency: {
		label: __("Emergency", "wds"),
		icon: "wds-custom-icon-ambulance",
		parent: "LocalBusiness"
	},
	Geriatric: {
		label: __("Geriatric", "wds"),
		icon: "wds-custom-icon-loveseat",
		parent: "LocalBusiness"
	},
	Gynecologic: {
		label: __("Gynecologic", "wds"),
		icon: "wds-custom-icon-female",
		parent: "LocalBusiness"
	},
	MedicalClinic: {
		label: __("Medical Clinic", "wds"),
		icon: "wds-custom-icon-clinic-medical",
		parent: "LocalBusiness"
	},
	Midwifery: {
		label: __("Midwifery", "wds"),
		icon: "wds-custom-icon-baby",
		parent: "LocalBusiness"
	},
	Nursing: {
		label: __("Nursing", "wds"),
		icon: "wds-custom-icon-user-nurse",
		parent: "LocalBusiness"
	},
	Obstetric: {
		label: __("Obstetric", "wds"),
		icon: "wds-custom-icon-baby",
		parent: "LocalBusiness"
	},
	Oncologic: {
		label: __("Oncologic", "wds"),
		icon: "wds-custom-icon-user-md",
		parent: "LocalBusiness"
	},
	Optician: {
		label: __("Optician", "wds"),
		icon: "wds-custom-icon-eye",
		parent: "LocalBusiness"
	},
	Optometric: {
		label: __("Optometric", "wds"),
		icon: "wds-custom-icon-glasses-alt",
		parent: "LocalBusiness"
	},
	Otolaryngologic: {
		label: __("Otolaryngologic", "wds"),
		icon: "wds-custom-icon-user-md-chat",
		parent: "LocalBusiness"
	},
	Pediatric: {
		label: __("Pediatric", "wds"),
		icon: "wds-custom-icon-child",
		parent: "LocalBusiness"
	},
	Pharmacy: {
		label: __("Pharmacy", "wds"),
		icon: "wds-custom-icon-pills",
		parent: "LocalBusiness"
	},
	Physician: {
		label: __("Physician", "wds"),
		icon: "wds-custom-icon-user-md",
		parent: "LocalBusiness"
	},
	Physiotherapy: {
		label: __("Physiotherapy", "wds"),
		icon: "wds-custom-icon-user-injured",
		parent: "LocalBusiness"
	},
	PlasticSurgery: {
		label: __("Plastic Surgery", "wds"),
		icon: "wds-custom-icon-lips",
		parent: "LocalBusiness"
	},
	Podiatric: {
		label: __("Podiatric", "wds"),
		icon: "wds-custom-icon-shoe-prints",
		parent: "LocalBusiness"
	},
	PrimaryCare: {
		label: __("Primary Care", "wds"),
		icon: "wds-custom-icon-comment-alt-medical",
		parent: "LocalBusiness"
	},
	Psychiatric: {
		label: __("Psychiatric", "wds"),
		icon: "wds-custom-icon-head-side-brain",
		parent: "LocalBusiness"
	},
	PublicHealth: {
		label: __("Public Health", "wds"),
		icon: "wds-custom-icon-clipboard-user",
		parent: "LocalBusiness"
	},
	ProfessionalService: {
		label: __("Professional Service", "wds"),
		icon: "wds-custom-icon-user-hard-hat",
		parent: "LocalBusiness"
	},
	RadioStation: {
		label: __("Radio Station", "wds"),
		icon: "wds-custom-icon-radio",
		parent: "LocalBusiness"
	},
	RealEstateAgent: {
		label: __("Real Estate Agent", "wds"),
		icon: "wds-custom-icon-sign",
		parent: "LocalBusiness"
	},
	RecyclingCenter: {
		label: __("Recycling Center", "wds"),
		icon: "wds-custom-icon-recycle",
		parent: "LocalBusiness"
	},
	SelfStorage: {
		label: __("Self Storage", "wds"),
		icon: "wds-custom-icon-warehouse-alt",
		parent: "LocalBusiness"
	},
	ShoppingCenter: {
		label: __("Shopping Center", "wds"),
		icon: "wds-custom-icon-bags-shopping",
		parent: "LocalBusiness"
	},
	SportsActivityLocation: {
		label: __("Sports Activity Location", "wds"),
		icon: "wds-custom-icon-volleyball-ball",
		parent: "LocalBusiness"
	},
	BowlingAlley: {
		label: __("Bowling Alley", "wds"),
		icon: "wds-custom-icon-bowling-pins",
		parent: "LocalBusiness"
	},
	ExerciseGym: {
		label: __("Exercise Gym", "wds"),
		icon: "wds-custom-icon-dumbbell",
		parent: "LocalBusiness"
	},
	GolfCourse: {
		label: __("Golf Course", "wds"),
		icon: "wds-custom-icon-golf-club",
		parent: "LocalBusiness"
	},
	PublicSwimmingPool: {
		label: __("Public Swimming Pool", "wds"),
		icon: "wds-custom-icon-swimmer",
		parent: "LocalBusiness"
	},
	SkiResort: {
		label: __("Ski Resort", "wds"),
		icon: "wds-custom-icon-skiing",
		parent: "LocalBusiness"
	},
	SportsClub: {
		label: __("Sports Club", "wds"),
		icon: "wds-custom-icon-football-ball",
		parent: "LocalBusiness"
	},
	StadiumOrArena: {
		label: __("Stadium Or Arena", "wds"),
		icon: "wds-custom-icon-pennant",
		parent: "LocalBusiness"
	},
	TennisComplex: {
		label: __("Tennis Complex", "wds"),
		icon: "wds-custom-icon-racquet",
		parent: "LocalBusiness"
	},
	Store: {
		label: __("Store", "wds"),
		icon: "wds-custom-icon-store-alt",
		parent: "LocalBusiness"
	},
	BikeStore: {
		label: __("Bike Store", "wds"),
		icon: "wds-custom-icon-bicycle",
		parent: "LocalBusiness"
	},
	BookStore: {
		label: __("Book Store", "wds"),
		icon: "wds-custom-icon-book",
		parent: "LocalBusiness"
	},
	ClothingStore: {
		label: __("Clothing Store", "wds"),
		icon: "wds-custom-icon-tshirt",
		parent: "LocalBusiness"
	},
	ComputerStore: {
		label: __("Computer Store", "wds"),
		icon: "wds-custom-icon-laptop",
		parent: "LocalBusiness"
	},
	ConvenienceStore: {
		label: __("Convenience Store", "wds"),
		icon: "wds-custom-icon-shopping-basket",
		parent: "LocalBusiness"
	},
	DepartmentStore: {
		label: __("Department Store", "wds"),
		icon: "wds-custom-icon-bags-shopping",
		parent: "LocalBusiness"
	},
	ElectronicsStore: {
		label: __("Electronics Store", "wds"),
		icon: "wds-custom-icon-boombox",
		parent: "LocalBusiness"
	},
	Florist: {
		label: __("Florist", "wds"),
		icon: "wds-custom-icon-flower-daffodil",
		parent: "LocalBusiness"
	},
	FurnitureStore: {
		label: __("Furniture Store", "wds"),
		icon: "wds-custom-icon-chair",
		parent: "LocalBusiness"
	},
	GardenStore: {
		label: __("Garden Store", "wds"),
		icon: "wds-custom-icon-seedling",
		parent: "LocalBusiness"
	},
	GroceryStore: {
		label: __("Grocery Store", "wds"),
		icon: "wds-custom-icon-shopping-cart",
		parent: "LocalBusiness"
	},
	HardwareStore: {
		label: __("Hardware Store", "wds"),
		icon: "wds-custom-icon-computer-speaker",
		parent: "LocalBusiness"
	},
	HobbyShop: {
		label: __("Hobby Shop", "wds"),
		icon: "wds-custom-icon-game-board",
		parent: "LocalBusiness"
	},
	HomeGoodsStore: {
		label: __("Home Goods Store", "wds"),
		icon: "wds-custom-icon-coffee-pot",
		parent: "LocalBusiness"
	},
	JewelryStore: {
		label: __("Jewelry Store", "wds"),
		icon: "wds-custom-icon-rings-wedding",
		parent: "LocalBusiness"
	},
	LiquorStore: {
		label: __("Liquor Store", "wds"),
		icon: "wds-custom-icon-jug",
		parent: "LocalBusiness"
	},
	MensClothingStore: {
		label: __("Mens Clothing Store", "wds"),
		icon: "wds-custom-icon-user-tie",
		parent: "LocalBusiness"
	},
	MobilePhoneStore: {
		label: __("Mobile Phone Store", "wds"),
		icon: "wds-custom-icon-mobile-alt",
		parent: "LocalBusiness"
	},
	MovieRentalStore: {
		label: __("Movie Rental Store", "wds"),
		icon: "wds-custom-icon-film",
		parent: "LocalBusiness"
	},
	MusicStore: {
		label: __("Music Store", "wds"),
		icon: "wds-custom-icon-album-collection",
		parent: "LocalBusiness"
	},
	OfficeEquipmentStore: {
		label: __("Office Equipment Store", "wds"),
		icon: "wds-custom-icon-chair-office",
		parent: "LocalBusiness"
	},
	OutletStore: {
		label: __("Outlet Store", "wds"),
		icon: "wds-custom-icon-tags",
		parent: "LocalBusiness"
	},
	PawnShop: {
		label: __("Pawn Shop", "wds"),
		icon: "wds-custom-icon-ring",
		parent: "LocalBusiness"
	},
	PetStore: {
		label: __("Pet Store", "wds"),
		icon: "wds-custom-icon-dog-leashed",
		parent: "LocalBusiness"
	},
	ShoeStore: {
		label: __("Shoe Store", "wds"),
		icon: "wds-custom-icon-boot",
		parent: "LocalBusiness"
	},
	SportingGoodsStore: {
		label: __("Sporting Goods Store", "wds"),
		icon: "wds-custom-icon-baseball",
		parent: "LocalBusiness"
	},
	TireShop: {
		label: __("Tire Shop", "wds"),
		icon: "wds-custom-icon-tire",
		parent: "LocalBusiness"
	},
	ToyStore: {
		label: __("Toy Store", "wds"),
		icon: "wds-custom-icon-gamepad-alt",
		parent: "LocalBusiness"
	},
	WholesaleStore: {
		label: __("Wholesale Store", "wds"),
		icon: "wds-custom-icon-boxes-alt",
		parent: "LocalBusiness"
	},
	TelevisionStation: {
		label: __("Television Station", "wds"),
		icon: "wds-custom-icon-tv-retro",
		parent: "LocalBusiness"
	},
	TouristInformationCenter: {
		label: __("Tourist Information Center", "wds"),
		icon: "wds-custom-icon-map-marked-alt",
		parent: "LocalBusiness"
	},
	TravelAgency: {
		label: __("Travel Agency", "wds"),
		icon: "wds-custom-icon-plane",
		parent: "LocalBusiness"
	},
	Product: {
		icon: 'wds-custom-icon-shopping-cart',
		label: __('Product', 'wds'),
	},
	WooProduct: {
		icon: 'wds-custom-icon-woocommerce',
		label: __('WooCommerce Product', 'wds'),
		condition: {id: id(), lhs: 'post_type', operator: '=', rhs: 'product'},
		disabled: !Config_Values.get('woocommerce', 'schema_types'),
		subTypesNotice: __('Note: Simple Product includes the <strong>Offer</strong> property, while Variable product includes the <strong>AggregateOffer</strong> property to fit the variation in pricing to your product.', 'wds'),
	},
	WooVariableProduct: {
		icon: 'wds-custom-icon-woocommerce',
		label: __('WooCommerce Variable Product', 'wds'),
		condition: {id: id(), lhs: 'product_type', operator: '=', rhs: 'WC_Product_Variable'},
		disabled: !Config_Values.get('woocommerce', 'schema_types'),
		parent: 'WooProduct',
	},
	WooSimpleProduct: {
		icon: 'wds-custom-icon-woocommerce',
		label: __('WooCommerce Simple Product', 'wds'),
		condition: {id: id(), lhs: 'product_type', operator: '=', rhs: 'WC_Product_Simple'},
		disabled: !Config_Values.get('woocommerce', 'schema_types'),
	},
};

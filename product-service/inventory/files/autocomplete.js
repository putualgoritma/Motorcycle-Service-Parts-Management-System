$(document).ready(function() {
var randLetter = String.fromCharCode(65 + Math.floor(Math.random() * 26));
var randomUniqueId = randLetter + Date.now();

//warehouse
var countries = new Bloodhound({
	datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
	queryTokenizer: Bloodhound.tokenizers.whitespace,
	limit: 10,
	remote: {
	ttl: 1,
	url: 'warehouse-list.php?search=%QUERY',
	wildcard: "%QUERY",
	filter: function(list) {
	return $.map(list, function(country) { return { name: country }; });
	}}
	});
	
countries.initialize();
	
$('.typehead_warehouse #warehouse_code').typeahead(null, {
	//name: 'countries',
	name: 'typehead_staff_mk' + randomUniqueId,
	displayKey: 'name',
	source: countries.ttAdapter()
	});
	
//warehouse from
var countries = new Bloodhound({
	datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
	queryTokenizer: Bloodhound.tokenizers.whitespace,
	limit: 10,
	remote: {
	ttl: 1,
	url: 'warehouse-list.php?search=%QUERY',
	wildcard: "%QUERY",
	filter: function(list) {
	return $.map(list, function(country) { return { name: country }; });
	}}
	});
	
countries.initialize();
	
$('.typehead_warehouse #warehouse_code_from').typeahead(null, {
	//name: 'countries',
	name: 'typehead_staff_mk' + randomUniqueId,
	displayKey: 'name',
	source: countries.ttAdapter()
	});

//staff mechanic
var countries = new Bloodhound({
	datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
	queryTokenizer: Bloodhound.tokenizers.whitespace,
	limit: 10,
	remote: {
	ttl: 1,
	url: '../../users/staff-mk-list.php?search=%QUERY',
	wildcard: "%QUERY",
	filter: function(list) {
	return $.map(list, function(country) { return { name: country }; });
	}}
	});
	
countries.initialize();
	
$('.typehead_staff_mk #staff_code').typeahead(null, {
	//name: 'countries',
	name: 'typehead_staff_mk' + randomUniqueId,
	displayKey: 'name',
	source: countries.ttAdapter()
	});

//motorcycle
var countries = new Bloodhound({
	datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
	queryTokenizer: Bloodhound.tokenizers.whitespace,
	limit: 10,
	remote: {
	ttl: 1,
	url: 'motorcycle-list.php?search=%QUERY',
	wildcard: "%QUERY",
	filter: function(list) {
	return $.map(list, function(country) { return { name: country }; });
	}}
	});
	
countries.initialize();
	
$('.typehead_motorcycle #motorcycle_code').typeahead(null, {
	//name: 'countries',
	name: 'typehead_motorcycle' + randomUniqueId,
	displayKey: 'name',
	source: countries.ttAdapter()
	});

//service
var countries = new Bloodhound({
	datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
	queryTokenizer: Bloodhound.tokenizers.whitespace,
	limit: 10,
	remote: {
	ttl: 1,
	url: 'service-list.php?search=%QUERY',
	wildcard: "%QUERY",
	filter: function(list) {
	return $.map(list, function(country) { return { name: country }; });
	}}
	});
	
countries.initialize();
	
$('.typehead_service #service_scode').typeahead(null, {
	//name: 'countries',
	name: 'typehead_account' + randomUniqueId,
	displayKey: 'name',
	source: countries.ttAdapter()
	});

//po order
var countries = new Bloodhound({
	datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
	queryTokenizer: Bloodhound.tokenizers.whitespace,
	limit: 10,
	remote: {
	ttl: 1,
	url: 'po-order-list.php?search=%QUERY',
	wildcard: "%QUERY",
	filter: function(list) {
	return $.map(list, function(country) { return { name: country }; });
	}}
	});
	
countries.initialize();
	
$('.typehead_po #po_code').typeahead(null, {
	//name: 'countries',
	name: 'typehead_po_' + randomUniqueId,
	displayKey: 'name',
	source: countries.ttAdapter()
	});
	
//hotline order
var countries = new Bloodhound({
	datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
	queryTokenizer: Bloodhound.tokenizers.whitespace,
	limit: 10,
	remote: {
	ttl: 1,
	url: 'hotline-order-list.php?search=%QUERY',
	wildcard: "%QUERY",
	filter: function(list) {
	return $.map(list, function(country) { return { name: country }; });
	}}
	});
	
countries.initialize();
	
$('.typehead_ho #po_code').typeahead(null, {
	//name: 'countries',
	name: 'typehead_ho_' + randomUniqueId,
	displayKey: 'name',
	source: countries.ttAdapter()
	});

//customer
var countries = new Bloodhound({
	datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
	queryTokenizer: Bloodhound.tokenizers.whitespace,
	limit: 10,
	remote: {
	ttl: 1,
	url: '../../users/customer-list.php?search=%QUERY',
	wildcard: "%QUERY",
	filter: function(list) {
	return $.map(list, function(country) { return { name: country }; });
	}}
	});
	
countries.initialize();
	
$('.typehead_customer #users_code').typeahead(null, {
	//name: 'countries',
	name: 'typehead_customer_' + randomUniqueId,
	displayKey: 'name',
	source: countries.ttAdapter()
	});

//area
var countries = new Bloodhound({
	datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
	queryTokenizer: Bloodhound.tokenizers.whitespace,
	limit: 10,
	remote: {
	ttl: 1,
	url: '../../users/area-list.php?search=%QUERY',
	wildcard: "%QUERY",
	filter: function(list) {
	return $.map(list, function(country) { return { name: country }; });
	}}
	});
	
countries.initialize();
	
$('.typehead_area #area_code').typeahead(null, {
	//name: 'countries',
	name: 'typehead_area' + randomUniqueId,
	displayKey: 'name',
	source: countries.ttAdapter()
	});

	
//city
var countries = new Bloodhound({
	datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
	queryTokenizer: Bloodhound.tokenizers.whitespace,
	limit: 10,
	remote: {
	ttl: 1,
	url: '../../users/city-list.php?search=%QUERY',
	wildcard: "%QUERY",
	filter: function(list) {
	return $.map(list, function(country) { return { name: country }; });
	}}
	});
	
countries.initialize();
	
$('.typehead_city #city_code').typeahead(null, {
	//name: 'countries',
	name: 'typehead_city' + randomUniqueId,
	displayKey: 'name',
	source: countries.ttAdapter()
	});
	
//religion
var countries = new Bloodhound({
	datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
	queryTokenizer: Bloodhound.tokenizers.whitespace,
	limit: 10,
	remote: {
	ttl: 1,
	url: '../../users/religion-list.php?search=%QUERY',
	wildcard: "%QUERY",
	filter: function(list) {
	return $.map(list, function(country) { return { name: country }; });
	}}
	});
	
countries.initialize();
	
$('.typehead_religion #religion_code').typeahead(null, {
	//name: 'countries',
	name: 'typehead_religion' + randomUniqueId,
	displayKey: 'name',
	source: countries.ttAdapter()
	});
	
//color
var countries = new Bloodhound({
	datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
	queryTokenizer: Bloodhound.tokenizers.whitespace,
	limit: 10,
	remote: {
	ttl: 1,
	url: 'color-list.php?search=%QUERY',
	wildcard: "%QUERY",
	filter: function(list) {
	return $.map(list, function(country) { return { name: country }; });
	}}
	});
	
countries.initialize();
	
$('.typehead_color #color_code').typeahead(null, {
	//name: 'countries',
	name: 'typehead_color' + randomUniqueId,
	displayKey: 'name',
	source: countries.ttAdapter()
	});

//motorcycle_type
var countries = new Bloodhound({
	datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
	queryTokenizer: Bloodhound.tokenizers.whitespace,
	limit: 10,
	remote: {
	ttl: 1,
	url: 'motorcycle-type-list.php?search=%QUERY',
	wildcard: "%QUERY",
	filter: function(list) {
	return $.map(list, function(country) { return { name: country }; });
	}}
	});
	
countries.initialize();
	
$('.typehead_motorcycle_type #motorcycle_type_code').typeahead(null, {
	//name: 'countries',
	name: 'typehead_motorcycle_type' + randomUniqueId,
	displayKey: 'name',
	source: countries.ttAdapter()
	});

//author
var countries = new Bloodhound({
	datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
	queryTokenizer: Bloodhound.tokenizers.whitespace,
	limit: 10,
	remote: {
	ttl: 1,
	url: '../../users/author-list.php?search=%QUERY',
	wildcard: "%QUERY",
	filter: function(list) {
	return $.map(list, function(country) { return { name: country }; });
	}}
	});
	
countries.initialize();
	
$('.typehead_author #author_code').typeahead(null, {
	//name: 'countries',
	name: 'typehead_author' + randomUniqueId,
	displayKey: 'name',
	source: countries.ttAdapter()
	});

//rack
var countries = new Bloodhound({
	datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
	queryTokenizer: Bloodhound.tokenizers.whitespace,
	limit: 10,
	remote: {
	ttl: 1,
	url: 'rack-list.php?search=%QUERY',
	wildcard: "%QUERY",
	filter: function(list) {
	return $.map(list, function(country) { return { name: country }; });
	}}
	});
	
countries.initialize();
	
$('.typehead_rack #rack_code').typeahead(null, {
	//name: 'countries',
	name: 'typehead_rack' + randomUniqueId,
	displayKey: 'name',
	source: countries.ttAdapter()
	});

//unit
var countries = new Bloodhound({
	datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
	queryTokenizer: Bloodhound.tokenizers.whitespace,
	limit: 10,
	remote: {
	ttl: 1,
	url: 'unit-list.php?search=%QUERY',
	wildcard: "%QUERY",
	filter: function(list) {
	return $.map(list, function(country) { return { name: country }; });
	}}
	});
	
countries.initialize();
	
$('.typehead_unit #unit_code').typeahead(null, {
	//name: 'countries',
	name: 'typehead_unit' + randomUniqueId,
	displayKey: 'name',
	source: countries.ttAdapter()
	});

//categorysub
var countries = new Bloodhound({
	datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
	queryTokenizer: Bloodhound.tokenizers.whitespace,
	limit: 10,
	remote: {
	ttl: 1,
	url: 'categorysub-list.php?search=%QUERY&categorysub_type=0',
	wildcard: "%QUERY",
	filter: function(list) {
	return $.map(list, function(country) { return { name: country }; });
	}}
	});
	
countries.initialize();
	
$('.typehead_categorysub #categorysub_code').typeahead(null, {
	//name: 'countries',
	name: 'typehead_categorysub' + randomUniqueId,
	displayKey: 'name',
	source: countries.ttAdapter()
	});

//category
var countries = new Bloodhound({
	datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
	queryTokenizer: Bloodhound.tokenizers.whitespace,
	limit: 10,
	remote: {
	ttl: 1,
	url: 'category-list.php?search=%QUERY&category_type=0',
	wildcard: "%QUERY",
	filter: function(list) {
	return $.map(list, function(country) { return { name: country }; });
	}}
	});
	
countries.initialize();
	
$('.typehead_category #category_code').typeahead(null, {
	//name: 'countries',
	name: 'typehead_category' + randomUniqueId,
	displayKey: 'name',
	source: countries.ttAdapter()
	});
	
//categorysub service
var countries = new Bloodhound({
	datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
	queryTokenizer: Bloodhound.tokenizers.whitespace,
	limit: 10,
	remote: {
	ttl: 1,
	url: 'categorysub-list.php?search=%QUERY&categorysub_type=1',
	wildcard: "%QUERY",
	filter: function(list) {
	return $.map(list, function(country) { return { name: country }; });
	}}
	});
	
countries.initialize();
	
$('.typehead_categorysub_service #categorysub_code').typeahead(null, {
	//name: 'countries',
	name: 'typehead_categorysub_service' + randomUniqueId,
	displayKey: 'name',
	source: countries.ttAdapter()
	});

//category service
var countries = new Bloodhound({
	datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
	queryTokenizer: Bloodhound.tokenizers.whitespace,
	limit: 10,
	remote: {
	ttl: 1,
	url: 'category-list.php?search=%QUERY&category_type=1',
	wildcard: "%QUERY",
	filter: function(list) {
	return $.map(list, function(country) { return { name: country }; });
	}}
	});
	
countries.initialize();
	
$('.typehead_category_service #category_code').typeahead(null, {
	//name: 'countries',
	name: 'typehead_category_service' + randomUniqueId,
	displayKey: 'name',
	source: countries.ttAdapter()
	});

//product price
var countries = new Bloodhound({
	datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
	queryTokenizer: Bloodhound.tokenizers.whitespace,
	limit: 10,
	remote: {
	ttl: 1,
	url: 'product-list.php?search=%QUERY',
	wildcard: "%QUERY",
	filter: function(list) {
	return $.map(list, function(country) { return { name: country }; });
	}}
	});
	
countries.initialize();
	
$('.typehead_product #product_code').typeahead(null, {
	//name: 'countries',
	name: 'typehead_account' + randomUniqueId,
	displayKey: 'name',
	source: countries.ttAdapter()
	});

//product bprice
var countries = new Bloodhound({
	datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
	queryTokenizer: Bloodhound.tokenizers.whitespace,
	limit: 10,
	remote: {
	ttl: 1,
	url: 'product-list.php?search=%QUERY',
	wildcard: "%QUERY",
	filter: function(list) {
	return $.map(list, function(country) { return { name: country }; });
	}}
	});
	
countries.initialize();
	
$('.typehead_product #product_bcode').typeahead(null, {
	//name: 'countries',
	name: 'typehead_account' + randomUniqueId,
	displayKey: 'name',
	source: countries.ttAdapter()
	});
	
//product bprice
var countries = new Bloodhound({
	datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
	queryTokenizer: Bloodhound.tokenizers.whitespace,
	limit: 10,
	remote: {
	ttl: 1,
	url: 'product-list.php?search=%QUERY',
	wildcard: "%QUERY",
	filter: function(list) {
	return $.map(list, function(country) { return { name: country }; });
	}}
	});
	
countries.initialize();
	
$('.typehead_product_opname #product_bcode').typeahead(null, {
	//name: 'countries',
	name: 'typehead_account' + randomUniqueId,
	displayKey: 'name',
	source: countries.ttAdapter()
	});
	
//product sprice
var countries = new Bloodhound({
	datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
	queryTokenizer: Bloodhound.tokenizers.whitespace,
	limit: 10,
	remote: {
	ttl: 1,
	url: 'product-list.php?search=%QUERY',
	wildcard: "%QUERY",
	filter: function(list) {
	return $.map(list, function(country) { return { name: country }; });
	}}
	});
	
countries.initialize();
	
$('.typehead_product #product_scode').typeahead(null, {
	//name: 'countries',
	name: 'typehead_account' + randomUniqueId,
	displayKey: 'name',
	source: countries.ttAdapter()
	});
	
//supplier
var countries = new Bloodhound({
	datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
	queryTokenizer: Bloodhound.tokenizers.whitespace,
	limit: 10,
	remote: {
	ttl: 1,
	url: '../../users/supplier-list.php?search=%QUERY',
	wildcard: "%QUERY",
	filter: function(list) {
	return $.map(list, function(country) { return { name: country }; });
	}}
	});
	
countries.initialize();
	
$('.typehead_supplier #users_code').typeahead(null, {
	//name: 'countries',
	name: 'typehead_supplier_' + randomUniqueId,
	displayKey: 'name',
	source: countries.ttAdapter()
	});

$('.firstin').focus();
});

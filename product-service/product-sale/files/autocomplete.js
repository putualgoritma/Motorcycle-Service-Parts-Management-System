$(document).ready(function() {
var randLetter = String.fromCharCode(65 + Math.floor(Math.random() * 26));
var randomUniqueId = randLetter + Date.now();

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
	
//product sprice
var countries = new Bloodhound({
	datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
	queryTokenizer: Bloodhound.tokenizers.whitespace,
	limit: 10,
	remote: {
	ttl: 1,
	url: '../inventory/product-list.php?search=%QUERY',
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
	
//hotline order
var countries = new Bloodhound({
	datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
	queryTokenizer: Bloodhound.tokenizers.whitespace,
	limit: 10,
	remote: {
	ttl: 1,
	url: '../inventory/hotline-order-list.php?search=%QUERY',
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

$('.firstin').focus();
});

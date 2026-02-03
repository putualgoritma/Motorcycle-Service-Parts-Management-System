$(document).ready(function() {
var randLetter = String.fromCharCode(65 + Math.floor(Math.random() * 26));
var randomUniqueId = randLetter + Date.now();

//product
var countries = new Bloodhound({
	datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
	queryTokenizer: Bloodhound.tokenizers.whitespace,
	limit: 10,
	remote: {
	ttl: 1,
	url: '../product-service/inventory/product-list.php?search=%QUERY',
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
	
//product available
var countries = new Bloodhound({
	datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
	queryTokenizer: Bloodhound.tokenizers.whitespace,
	limit: 10,
	remote: {
	ttl: 1,
	url: '../product-service/inventory/product-list-available.php?search=%QUERY',
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
	
//account
var countries = new Bloodhound({
	datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
	queryTokenizer: Bloodhound.tokenizers.whitespace,
	limit: 10,
	remote: {
	ttl: 1,
	url: '../book/taxonomi-list.php?search=%QUERY',
	wildcard: "%QUERY",
	filter: function(list) {
	return $.map(list, function(country) { return { name: country }; });
	}}
	});
	
countries.initialize();
	
$('.typehead_account #taxonomi_code').typeahead(null, {
	//name: 'countries',
	name: 'typehead_account' + randomUniqueId,
	displayKey: 'name',
	source: countries.ttAdapter()
	});


//users
var countries = new Bloodhound({
	datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
	queryTokenizer: Bloodhound.tokenizers.whitespace,
	limit: 10,
	remote: {
	ttl: 1,
	url: '../users/users-list.php?search=%QUERY&type=',
	wildcard: "%QUERY",
	filter: function(list) {
	return $.map(list, function(country) { return { name: country }; });
	}}
	});
	
countries.initialize();
	
$('.typehead_users #users_code').typeahead(null, {
	//name: 'countries',
	name: 'typehead_users_' + randomUniqueId,
	displayKey: 'name',
	source: countries.ttAdapter()
	});

//members
var countries = new Bloodhound({
	datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
	queryTokenizer: Bloodhound.tokenizers.whitespace,
	limit: 10,
	remote: {
	ttl: 1,
	url: '../users/users-list.php?search=%QUERY&type= AND (users_type =\'member\' OR users_type =\'candidate\')',
	wildcard: "%QUERY",
	filter: function(list) {
	return $.map(list, function(country) { return { name: country }; });
	}}
	});
	
countries.initialize();
	
$('.typehead_member #users_code').typeahead(null, {
	//name: 'countries',
	name: 'typehead_member_' + randomUniqueId,
	displayKey: 'name',
	source: countries.ttAdapter()
	});

//search
var countries = new Bloodhound({
	datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
	queryTokenizer: Bloodhound.tokenizers.whitespace,
	limit: 10,
	remote: {
	ttl: 1,
	url: '../users/users-list.php?search=%QUERY&type= AND (users_type =\'member\' OR users_type =\'candidate\')',
	wildcard: "%QUERY",
	filter: function(list) {
	return $.map(list, function(country) { return { name: country }; });
	}}
	});
	
countries.initialize();
	
$('.typehead_member #search').typeahead(null, {
	//name: 'countries',
	name: 'typehead_member_' + randomUniqueId,
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
	url: '../users/users-list.php?search=%QUERY&type= AND users_type =\'supplier\'',
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
	
//account2
var countries = new Bloodhound({
	datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
	queryTokenizer: Bloodhound.tokenizers.whitespace,
	limit: 10,
	remote: {
	ttl: 1,
	url: '../book/taxonomi-list.php?search=%QUERY',
	wildcard: "%QUERY",
	filter: function(list) {
	return $.map(list, function(country) { return { name: country }; });
	}}
	});
	
countries.initialize();
	
$('.typehead_account #payreceivable_accountdebit').typeahead(null, {
	//name: 'countries',
	name: 'typehead_account' + randomUniqueId,
	displayKey: 'name',
	source: countries.ttAdapter()
	});
	
//account3
var countries = new Bloodhound({
	datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
	queryTokenizer: Bloodhound.tokenizers.whitespace,
	limit: 10,
	remote: {
	ttl: 1,
	url: '../book/taxonomi-list.php?search=%QUERY',
	wildcard: "%QUERY",
	filter: function(list) {
	return $.map(list, function(country) { return { name: country }; });
	}}
	});
	
countries.initialize();
	
$('.typehead_account #payreceivable_accountcredit').typeahead(null, {
	//name: 'countries',
	name: 'typehead_account' + randomUniqueId,
	displayKey: 'name',
	source: countries.ttAdapter()
	});
	
$('.firstin').focus();
});
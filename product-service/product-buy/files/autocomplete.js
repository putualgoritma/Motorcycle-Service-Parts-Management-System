
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



//po order

var countries = new Bloodhound({

	datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),

	queryTokenizer: Bloodhound.tokenizers.whitespace,

	limit: 10,

	remote: {

	ttl: 1,

	url: '../inventory/po-order-list.php?search=%QUERY',
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

	

//product bprice

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

	

$('.typehead_product #product_bcode').typeahead(null, {

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


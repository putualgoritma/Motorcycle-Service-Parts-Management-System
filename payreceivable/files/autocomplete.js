$(document).ready(function() {
var randLetter = String.fromCharCode(65 + Math.floor(Math.random() * 26));
var randomUniqueId = randLetter + Date.now();

//recievable
var countries = new Bloodhound({
	datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
	queryTokenizer: Bloodhound.tokenizers.whitespace,
	limit: 10,
	remote: {
	ttl: 1,
	url: 'receivable-list.php?search=%QUERY',
	wildcard: "%QUERY",
	filter: function(list) {
	return $.map(list, function(country) { return { name: country }; });
	}}
	});
	
countries.initialize();
	
$('.typehead_payreceivable #payreceivable_accountcredit').typeahead(null, {
	//name: 'countries',
	name: 'typehead_users_' + randomUniqueId,
	displayKey: 'name',
	source: countries.ttAdapter()
	});
	
//payable
var countries = new Bloodhound({
	datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
	queryTokenizer: Bloodhound.tokenizers.whitespace,
	limit: 10,
	remote: {
	ttl: 1,
	url: 'payable-list.php?search=%QUERY',
	wildcard: "%QUERY",
	filter: function(list) {
	return $.map(list, function(country) { return { name: country }; });
	}}
	});
	
countries.initialize();
	
$('.typehead_payable #payreceivable_accountcredit').typeahead(null, {
	//name: 'countries',
	name: 'typehead_users_' + randomUniqueId,
	displayKey: 'name',
	source: countries.ttAdapter()
	});
	
//recievable staff
var countries = new Bloodhound({
	datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
	queryTokenizer: Bloodhound.tokenizers.whitespace,
	limit: 10,
	remote: {
	ttl: 1,
	url: 'receivable-staff-list.php?search=%QUERY',
	wildcard: "%QUERY",
	filter: function(list) {
	return $.map(list, function(country) { return { name: country }; });
	}}
	});
	
countries.initialize();
	
$('.typehead_payreceivable_staff #payreceivable_staff_accountcredit').typeahead(null, {
	//name: 'countries',
	name: 'typehead_users_' + randomUniqueId,
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
	
//staff
var countries = new Bloodhound({
	datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
	queryTokenizer: Bloodhound.tokenizers.whitespace,
	limit: 10,
	remote: {
	ttl: 1,
	url: '../users/staff-list.php?search=%QUERY&type=',
	wildcard: "%QUERY",
	filter: function(list) {
	return $.map(list, function(country) { return { name: country }; });
	}}
	});
	
countries.initialize();
	
$('.typehead_staff #staff_code').typeahead(null, {
	//name: 'countries',
	name: 'typehead_users_' + randomUniqueId,
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
	
$('.typehead_account #payreceivable_accountcredit').typeahead(null, {
	//name: 'countries',
	name: 'typehead_account' + randomUniqueId,
	displayKey: 'name',
	source: countries.ttAdapter()
	});
	
//account debit
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

$('.firstin').focus();
});

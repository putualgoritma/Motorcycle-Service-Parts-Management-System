$(document).ready(function() {
var randLetter = String.fromCharCode(65 + Math.floor(Math.random() * 26));
var randomUniqueId = randLetter + Date.now();

//taxonomy expense
var countries = new Bloodhound({
	datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
	queryTokenizer: Bloodhound.tokenizers.whitespace,
	limit: 10,
	remote: {
	ttl: 1,
	url: 'ajax/taxonomi-typehead.php?search=%QUERY&stype=Biaya',
	wildcard: "%QUERY",
	filter: function(list) {
	return $.map(list, function(country) { return { name: country }; });
	}}
	});
	
countries.initialize();
	
$('.typehead_texpense #taxonomi_code').typeahead(null, {
	//name: 'countries',
	name: 'taxonomi_code' + randomUniqueId,
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
	url: 'ajax/taxonomi-typehead.php?search=%QUERY',
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
	
});

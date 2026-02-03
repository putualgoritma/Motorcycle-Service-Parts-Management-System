$(document).ready(function() {
var randLetter = String.fromCharCode(65 + Math.floor(Math.random() * 26));
var randomUniqueId = randLetter + Date.now();

//village
var countries = new Bloodhound({
	datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
	queryTokenizer: Bloodhound.tokenizers.whitespace,
	limit: 10,
	remote: {
	ttl: 1,
	url: 'village-list.php?search=%QUERY',
	wildcard: "%QUERY",
	filter: function(list) {
	return $.map(list, function(country) { return { name: country }; });
	}}
	});
	
countries.initialize();
	
$('.typehead_village #village_code').typeahead(null, {
	//name: 'countries',
	name: 'typehead_village_' + randomUniqueId,
	displayKey: 'name',
	source: countries.ttAdapter()
	});

//position
var countries = new Bloodhound({
	datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
	queryTokenizer: Bloodhound.tokenizers.whitespace,
	limit: 10,
	remote: {
	ttl: 1,
	url: 'position-list.php?search=%QUERY',
	wildcard: "%QUERY",
	filter: function(list) {
	return $.map(list, function(country) { return { name: country }; });
	}}
	});
	
countries.initialize();
	
$('.typehead_position #position_code').typeahead(null, {
	//name: 'countries',
	name: 'typehead_position' + randomUniqueId,
	displayKey: 'name',
	source: countries.ttAdapter()
	});

//education
var countries = new Bloodhound({
	datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
	queryTokenizer: Bloodhound.tokenizers.whitespace,
	limit: 10,
	remote: {
	ttl: 1,
	url: 'education-list.php?search=%QUERY',
	wildcard: "%QUERY",
	filter: function(list) {
	return $.map(list, function(country) { return { name: country }; });
	}}
	});
	
countries.initialize();
	
$('.typehead_education #education_code').typeahead(null, {
	//name: 'countries',
	name: 'typehead_education' + randomUniqueId,
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
	url: 'area-list.php?search=%QUERY',
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
	url: 'city-list.php?search=%QUERY',
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
	url: 'religion-list.php?search=%QUERY',
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

$('.firstin').focus();
});

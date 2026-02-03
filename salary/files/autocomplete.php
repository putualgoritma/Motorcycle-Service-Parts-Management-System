<script>
$(document).ready(function() {
var randLetter = String.fromCharCode(65 + Math.floor(Math.random() * 26));
var randomUniqueId = randLetter + Date.now();

//staff
var countries = new Bloodhound({
	datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
	queryTokenizer: Bloodhound.tokenizers.whitespace,
	limit: 10,
	remote: {
	ttl: 1,
	url: '../users/staff-list.php?search=%QUERY',
	wildcard: "%QUERY",
	filter: function(list) {
	return $.map(list, function(country) { return { name: country }; });
	}}
	});
	
countries.initialize();
	
$('.typehead_staff #staff_code').typeahead(null, {
	//name: 'countries',
	name: 'typehead_staff' + randomUniqueId,
	displayKey: 'name',
	source: countries.ttAdapter()
	});
	
});
</script>
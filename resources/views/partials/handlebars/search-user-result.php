<script id="search-user-list-template" type="text/x-handlebars-template">
{{#each users}}

<a href="{{../baseURL}}/bid/{{../acc_type}}/{{this.identifier}}/{{this.username}}">
	<div class="row user-search-result">
		<div class="avatar">
			<img src="{{this.avatar}}" alt="image">
		</div>
		<div class="description">
				<div>{{this.username}}</div>
				<div class="social-label">
					<span class="{{../acc_icon}} search-result-icon"></span>
					{{../acc_type}}
				</div>
			</div>
			<div class="right-arrow"></div>
		</div>
	</div>
</a>
{{/each}}
</script>
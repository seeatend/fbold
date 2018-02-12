<!DOCTYPE html>
<html lang="en">
@include('layouts.partials.frontend._head')
<body>
	@include('layouts.partials.frontend._navbar')      
	@include('layouts.partials.frontend._messages')
	
	@yield('content')

	@include('layouts.partials.frontend._footer')
	@include('layouts.partials.frontend._assets')

</body>
</html>
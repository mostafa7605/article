@extends('admin.layouts.app')
	@section('content')
@if(session('status'))
<p id="alert-wishlist"class="alert alert-success"> {{ session('status') }}</p>
@endif
<nav class="table-media">
	<div class="nav nav-tabs" id="nav-tab" role="tablist">
		<a style="    margin-left: 30px;" class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-book" role="tab" aria-controls="nav-home" aria-selected="true">
			<svg xmlns="http://www.w3.org/2000/svg" width="26.682" height="26.83" viewBox="0 0 26.682 26.83">
				<g id="Group_394" data-name="Group 394" transform="translate(-3246.454 338.802)">
					<path id="Path_568" data-name="Path 568" d="M3267.493-338.8a.6.6,0,0,1,.258.56c-.013.453,0,.906,0,1.387.411-.137.8-.268,1.184-.391.274-.087.552-.161.828-.243a.5.5,0,0,1,.543.152c.349.367.713.719,1.063,1.085.095.1.168.124.285.039a.955.955,0,0,1,1.486.886c-.022,3.86-.01,7.719-.01,11.579a1.354,1.354,0,0,1-.01.209.365.365,0,0,1-.392.344.359.359,0,0,1-.372-.336,2.46,2.46,0,0,1-.012-.34q0-5.659,0-11.317a2.073,2.073,0,0,0-.007-.262c-.017-.133-.09-.186-.219-.12-.07.035-.138.076-.206.114q-4.8,2.7-9.6,5.394a.618.618,0,0,0-.367.631q.016,7.912.008,15.823c0,.07,0,.14,0,.21.007.276.073.318.313.185q1.155-.643,2.305-1.292,3.751-2.11,7.5-4.217a.456.456,0,0,0,.278-.469c-.016-.593-.006-1.187,0-1.781a.432.432,0,0,1,.132-.381.4.4,0,0,1,.418-.061.347.347,0,0,1,.231.347c0,.725.008,1.449-.007,2.174a.92.92,0,0,1-.557.795q-2.124,1.188-4.243,2.385l-5.633,3.169a1.028,1.028,0,0,1-.793.18c-.089-.024-.126.03-.173.082a.972.972,0,0,1-.773.315q-1.152-.008-2.305,0a.955.955,0,0,1-.771-.317.189.189,0,0,0-.2-.077,1.041,1.041,0,0,1-.7-.15q-4.995-2.809-9.989-5.618a.939.939,0,0,1-.518-.848q0-.079,0-.157,0-8.082,0-16.164a.951.951,0,0,1,.7-1.056.886.886,0,0,1,.748.133.216.216,0,0,0,.328-.046c.317-.337.66-.65.968-1a.641.641,0,0,1,.747-.193c.618.182,1.232.374,1.885.617,0-.479.008-.926,0-1.374a.6.6,0,0,1,.257-.586h.262c.349.156.7.3,1.047.469a12.389,12.389,0,0,1,5.771,5.307c.23.426.416.873.6,1.313.079-.013.076-.066.09-.1a11.782,11.782,0,0,1,5.126-5.88,20.23,20.23,0,0,1,2.246-1.107Zm-9.856,17.288h0q0-4.033,0-8.067a.414.414,0,0,0-.244-.413q-3.14-1.756-6.273-3.522-1.79-1.006-3.58-2.014c-.229-.129-.292-.091-.3.168,0,.052,0,.1,0,.157q0,7.988-.005,15.977a.5.5,0,0,0,.294.512q4.874,2.728,9.738,5.473c.306.172.369.132.369-.23Q3257.637-317.494,3257.637-321.514Zm.759-11.213a11.427,11.427,0,0,0-5.647-5.038c-.123-.056-.13.006-.129.1,0,.3.011.594,0,.89a.312.312,0,0,0,.222.351c.439.191.869.4,1.3.618.264.131.34.333.23.551s-.316.277-.578.153c-.063-.03-.125-.062-.187-.094a21.294,21.294,0,0,0-3.615-1.439.34.34,0,0,0-.409.109c-.177.2-.377.389-.566.582-.212.216-.212.217.046.362,2.874,1.617,5.752,3.224,8.616,4.859a2.406,2.406,0,0,0,1.479.228,9.51,9.51,0,0,0-1.086-1.407,14,14,0,0,0-2.072-1.842.4.4,0,0,1-.014-.691c.19-.12.346-.039.5.076A17.177,17.177,0,0,1,3258.4-332.727Zm2.762,11.506c0-1.553,0-3.106,0-4.659,0-.168-.023-.247-.222-.244-.767.012-1.535.01-2.3,0-.175,0-.217.054-.217.222q.007,4.672,0,9.344c0,.185.054.235.236.233.75-.01,1.5-.012,2.251,0,.213,0,.258-.066.257-.265C3261.155-318.133,3261.158-319.677,3261.158-321.222Zm-.717-9.292a2.24,2.24,0,0,0,1.724-.354c1.047-.628,2.124-1.205,3.188-1.8q2.611-1.469,5.224-2.935c.165-.092.2-.151.047-.289a7.81,7.81,0,0,1-.624-.635.337.337,0,0,0-.41-.1,20.774,20.774,0,0,0-2.744,1.017,16.113,16.113,0,0,0-5.369,3.755A9,9,0,0,0,3260.441-330.514Zm.734-2.216c.392-.354.776-.716,1.185-1.051a18.743,18.743,0,0,1,4.373-2.644c.1-.043.229-.05.229-.209,0-.381,0-.762,0-1.188A11.655,11.655,0,0,0,3261.175-332.73Zm-1.4,4.084c.4,0,.8,0,1.2,0,.135,0,.187-.041.182-.179-.008-.217-.007-.436,0-.653,0-.159-.063-.215-.218-.214q-1.15.006-2.3,0c-.178,0-.226.079-.22.239.008.2.01.4,0,.6-.009.159.045.212.207.208C3259.01-328.653,3259.393-328.646,3259.776-328.646Zm0,15.887c.384,0,.767,0,1.15,0,.167,0,.239-.059.233-.229a5.609,5.609,0,0,1,0-.6c.012-.173-.049-.222-.219-.22-.584.01-1.168,0-1.752.006-.249,0-.6-.116-.721.052s-.035.5-.047.761c-.008.169.063.234.231.23C3259.027-312.764,3259.4-312.76,3259.777-312.76Zm.014-15.1c-.218,0-.437-.008-.654,0s-.547-.108-.671.053-.027.451-.045.684c-.013.173.049.221.219.218.593-.01,1.187,0,1.78-.007.24,0,.569.112.7-.052s.03-.467.044-.71c.009-.149-.043-.2-.192-.193C3260.576-327.854,3260.183-327.86,3259.79-327.86Zm-.024,13.271c.227,0,.454,0,.68,0s.531.075.656-.04c.161-.148.029-.46.057-.7.02-.176-.053-.219-.22-.217-.593.009-1.187,0-1.78.007-.24,0-.567-.114-.7.054s-.029.468-.044.711c-.01.153.051.192.195.189C3259-314.6,3259.383-314.589,3259.767-314.589Z" fill="#fff"/>
					<path id="Path_569" data-name="Path 569" d="M3483.985-235.535c0-.375.011-.751,0-1.125a.543.543,0,0,1,.316-.545q2.876-1.633,5.745-3.28c.469-.268.937-.539,1.409-.8a.4.4,0,0,1,.654.382c.007.785,0,1.571,0,2.356a.546.546,0,0,1-.331.514q-3.078,1.753-6.152,3.514c-.325.186-.65.374-.978.554-.375.206-.659.038-.663-.389C3483.982-234.749,3483.985-235.142,3483.985-235.535Zm7.335-4.768c-.125.068-.2.108-.276.151-1.946,1.111-3.886,2.232-5.843,3.325a.7.7,0,0,0-.438.766c.036.356.008.718.008,1.119l1-.571q2.669-1.524,5.336-3.05c.092-.053.213-.079.211-.233C3491.316-239.283,3491.32-239.769,3491.32-240.3Z" transform="translate(-220.898 -90.611)" fill="#fff"/>
					<path id="Path_570" data-name="Path 570" d="M3432.129-124.191q0,1.086,0,2.172a1.208,1.208,0,0,1-.023.285.357.357,0,0,1-.384.288.353.353,0,0,1-.356-.29,1.442,1.442,0,0,1-.022-.312q0-2.146,0-4.291a1.354,1.354,0,0,1,.023-.312.349.349,0,0,1,.358-.286.354.354,0,0,1,.382.289,1.21,1.21,0,0,1,.022.286Q3432.13-125.277,3432.129-124.191Z" transform="translate(-171.945 -197.034)" fill="#fff"/>
				</g>
			</svg>
			<span>Book</span>
            @if(count($book_unapproved)>0)
			<span class="counter">{{ count($book_unapproved) }}</span>
            @endif
		</a>
		<a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-article" role="tab" aria-controls="nav-profile" aria-selected="false">
			<svg xmlns="http://www.w3.org/2000/svg" width="21.246" height="26.83" viewBox="0 0 21.246 26.83">
				<g id="Group_397" data-name="Group 397" transform="translate(-4841.383 -706.887)">
					<path id="Path_571" data-name="Path 571" d="M4862.627,721.151q0,5.122,0,10.244a2.178,2.178,0,0,1-2.259,2.322q-7.571,0-15.141,0a2.117,2.117,0,0,1-2.153-1.543.292.292,0,0,0-.2-.211,2.119,2.119,0,0,1-1.489-2.116q-.006-10.35,0-20.7a2.132,2.132,0,0,1,2.24-2.253q7.583-.011,15.168,0a2.12,2.12,0,0,1,2.148,1.55.276.276,0,0,0,.181.2,2.143,2.143,0,0,1,1.5,2.187q0,3.534,0,7.068Zm-20.407-1.681q0,5.148,0,10.3a1.44,1.44,0,0,0,.432,1.123,1.508,1.508,0,0,0,1.1.358q4.963,0,9.926,0c1.694,0,3.388,0,5.082,0a1.325,1.325,0,0,0,1.438-1.411q0-10.35,0-20.7a1.315,1.315,0,0,0-1.411-1.408q-7.583-.006-15.167,0a1.342,1.342,0,0,0-1.4,1.449Q4842.223,714.321,4842.22,719.469Zm18.813-9.977v.388c0,6.618-.012,13.236.009,19.854a2.241,2.241,0,0,1-2.349,2.35c-1.1-.042-2.206-.009-3.309-.009q-5.585,0-11.171,0c-.082,0-.2-.049-.24.046s.057.159.108.228a1.416,1.416,0,0,0,1.234.533q5.651-.006,11.3,0c1.235,0,2.471,0,3.706,0a1.43,1.43,0,0,0,1.046-.362,1.455,1.455,0,0,0,.422-1.127q0-10.258,0-20.515a2.747,2.747,0,0,0-.009-.291A1.348,1.348,0,0,0,4861.033,709.493Z" transform="translate(0)" fill="#4e4e4e"/>
					<path id="Path_572" data-name="Path 572" d="M4898.16,946.071h-5.607a2.319,2.319,0,0,1-.238,0,.418.418,0,0,1,0-.835,1.978,1.978,0,0,1,.212,0h11.294a1.28,1.28,0,0,1,.238.007.417.417,0,0,1,0,.828,1.329,1.329,0,0,1-.238.006Z" transform="translate(-46.965 -221.481)" fill="#4e4e4e"/>
					<path id="Path_573" data-name="Path 573" d="M4898.158,851.91h-5.613a1.56,1.56,0,0,1-.264-.008.383.383,0,0,1-.348-.373.376.376,0,0,1,.282-.423,1.089,1.089,0,0,1,.313-.034q5.652,0,11.3,0a1.11,1.11,0,0,1,.313.034.376.376,0,0,1,.286.421.385.385,0,0,1-.345.376,1.511,1.511,0,0,1-.264.008Z" transform="translate(-46.973 -133.984)" fill="#4e4e4e"/>
					<path id="Path_574" data-name="Path 574" d="M4898.19,992.328h5.661a1.093,1.093,0,0,1,.263.013.39.39,0,0,1,.322.37.4.4,0,0,1-.281.428.841.841,0,0,1-.314.028h-11.321a1.064,1.064,0,0,1-.263-.017.415.415,0,0,1,.035-.816,1.28,1.28,0,0,1,.237-.007Z" transform="translate(-46.976 -265.247)" fill="#4e4e4e"/>
					<path id="Path_575" data-name="Path 575" d="M4898.18,899h-5.66a1.138,1.138,0,0,1-.263-.011.388.388,0,0,1-.326-.366.393.393,0,0,1,.275-.431.907.907,0,0,1,.34-.03h11.268a2.1,2.1,0,0,1,.211,0,.415.415,0,0,1,.408.432.406.406,0,0,1-.434.4c-.5.007-1,0-1.508,0Z" transform="translate(-46.97 -177.739)" fill="#4e4e4e"/>
					<path id="Path_576" data-name="Path 576" d="M4898.2,804.888h-5.612a1.68,1.68,0,0,1-.316-.013.41.41,0,0,1-.033-.8,1.247,1.247,0,0,1,.315-.026q5.638,0,11.277,0a1.173,1.173,0,0,1,.314.028.409.409,0,0,1-.043.8,1.616,1.616,0,0,1-.29.012Z" transform="translate(-46.978 -90.291)" fill="#4e4e4e"/>
					<path id="Path_577" data-name="Path 577" d="M4898.17,757.061h5.612a1.506,1.506,0,0,1,.316.016.409.409,0,0,1,.01.8,1.373,1.373,0,0,1-.315.021h-11.25c-.044,0-.088,0-.132,0-.321-.012-.5-.164-.493-.426s.181-.406.51-.407Q4895.3,757.059,4898.17,757.061Z" transform="translate(-46.959 -46.625)" fill="#4e4e4e"/>
				</g>
			</svg>

			<span>Article</span>
            @if(count($articles_unapproved)>0)
			<span class="counter">{{ count($articles_unapproved) }}</span>
            @endif
		</a>
		<a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-video" role="tab" aria-controls="nav-contact" aria-selected="false">
			<svg xmlns="http://www.w3.org/2000/svg" width="28.127" height="23.736" viewBox="0 0 28.127 23.736">
				<g id="Group_400" data-name="Group 400" transform="translate(-2569.421 -208.761)">
					<path id="Path_578" data-name="Path 578" d="M2597.548,230.131a5.691,5.691,0,0,1-.239.721,2.676,2.676,0,0,1-2.547,1.637c-2.06.014-4.119,0-6.179,0q-8.157,0-16.313,0a2.753,2.753,0,0,1-2.768-2.1,3.027,3.027,0,0,1-.081-.734q0-9.035,0-18.071a2.739,2.739,0,0,1,2.826-2.826q4.312-.006,8.623,0a1.519,1.519,0,0,1,.219.007.547.547,0,0,1,.008,1.082,2.045,2.045,0,0,1-.3.009h-8.459a1.663,1.663,0,0,0-1.819,1.826q0,6.4-.007,12.8c0,.271.072.324.331.324q12.647-.011,25.293,0c.241,0,.318-.049.318-.308q-.014-6.426-.007-12.853a1.654,1.654,0,0,0-1.777-1.786h-8.486a2.386,2.386,0,0,1-.274-.005.546.546,0,0,1,.008-1.089,2.636,2.636,0,0,1,.275,0h8.349a2.752,2.752,0,0,1,2.972,2.321c0,.016.022.028.033.041Zm-14.065-4.23q-6.316,0-12.633-.006c-.249,0-.342.037-.337.318.019,1.144.006,2.288.008,3.433a1.652,1.652,0,0,0,1.76,1.748h22.41a1.652,1.652,0,0,0,1.758-1.751c0-1.144-.007-2.289.006-3.433,0-.247-.057-.316-.311-.315Q2589.813,225.908,2583.483,225.9Z" fill="#4e4e4e"/>
					<path id="Path_579" data-name="Path 579" d="M2722.812,284.732c0-.549-.005-1.1,0-1.647a1.551,1.551,0,0,1,2.331-1.383q1.478.811,2.92,1.688a1.54,1.54,0,0,1,.01,2.664q-1.449.888-2.943,1.7a1.55,1.55,0,0,1-2.317-1.377C2722.805,285.83,2722.812,285.281,2722.812,284.732Zm1.1-.007c0,.531,0,1.061,0,1.592a.47.47,0,0,0,.761.441q1.382-.787,2.755-1.59a.471.471,0,0,0,0-.883q-1.373-.8-2.755-1.59a.47.47,0,0,0-.762.439C2723.907,283.664,2723.91,284.194,2723.91,284.725Z" transform="translate(-142.131 -67.394)" fill="#4e4e4e"/>
					<path id="Path_580" data-name="Path 580" d="M2754.76,209.365a.547.547,0,0,1-.543.535.547.547,0,1,1,0-1.095A.546.546,0,0,1,2754.76,209.365Z" transform="translate(-170.723 -0.041)" fill="#4e4e4e"/>
					<path id="Path_581" data-name="Path 581" d="M2706.343,472.249h6.616a2.456,2.456,0,0,1,.274.005.547.547,0,0,1,0,1.089,2.515,2.515,0,0,1-.274,0h-13.232c-.507,0-.762-.179-.77-.538s.258-.561.774-.561Z" transform="translate(-120.026 -244.15)" fill="#4e4e4e"/>
					<path id="Path_582" data-name="Path 582" d="M2621.816,458.94a1.647,1.647,0,1,1,1.631,1.654A1.647,1.647,0,0,1,2621.816,458.94Zm2.194.012a.558.558,0,0,0-.53-.552.548.548,0,0,0-.038,1.094A.558.558,0,0,0,2624.01,458.952Z" transform="translate(-48.55 -230.299)" fill="#4e4e4e"/>
				</g>
			</svg>

			<span>Video films</span>
            @if(count($video_films_unapproved)>0)
			<span class="counter">{{ count($video_films_unapproved) }}</span>
            @endif
		</a>
		<a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-cover" role="tab" aria-controls="nav-contact" aria-selected="false">
			<svg xmlns="http://www.w3.org/2000/svg" width="25.676" height="25.67" viewBox="0 0 25.676 25.67">
				<g id="Group_403" data-name="Group 403" transform="translate(-3101.548 -626.288)">
					<path id="Path_583" data-name="Path 583" d="M3101.548,645.89a7.411,7.411,0,0,1,.216-.739,2.786,2.786,0,0,1,1.41-1.529c.2-.094.2-.18.13-.358a11.3,11.3,0,0,1-.748-4.416,11.594,11.594,0,0,1,3.567-8.193,11.31,11.31,0,0,1,6.578-3.246,11.578,11.578,0,0,1,9.891,3.2c.278.263.648.244.936.44.042.029.077,0,.077-.057s0-.117,0-.175q0-1.58,0-3.159c0-.407.093-.525.488-.638.818-.235,1.635-.474,2.453-.706a.5.5,0,0,1,.656.335.509.509,0,0,1-.365.622c-.071.024-.144.041-.217.062-.609.175-1.218.354-1.829.524-.132.037-.188.089-.187.237q0,2.47-.006,4.94a.511.511,0,0,0,.085.257,11.71,11.71,0,0,1,1.476,7,11.593,11.593,0,0,1-1.884,5.33.5.5,0,1,1-.835-.549,10.871,10.871,0,0,0,.659-10.748c-.106.014-.148.1-.209.149a2.1,2.1,0,1,1-2.564-3.316c.194-.128.209-.18.025-.331a10.32,10.32,0,0,0-7.788-2.48,10.507,10.507,0,0,0-9.47,7.45,10.294,10.294,0,0,0,.22,7.332.239.239,0,0,0,.255.177,2.835,2.835,0,0,1,1.534.477c.115.078.188.044.29-.018a2.938,2.938,0,0,1,4.449,1.831,2.844,2.844,0,0,1-.728,2.688,7.513,7.513,0,0,1-.587.522,10.4,10.4,0,0,0,2.794.951,10.736,10.736,0,0,0,7.941-1.533.633.633,0,0,1,.464-.147.5.5,0,0,1,.178.925,10.848,10.848,0,0,1-1.895,1.016,11.731,11.731,0,0,1-9.986-.346.261.261,0,0,0-.362.065c-.644.656-1.3,1.3-1.946,1.954a1.4,1.4,0,0,1-.356.272h-.251a1.4,1.4,0,0,1-.337-.255q-1.655-1.66-3.313-3.317a4.516,4.516,0,0,1-.314-.357,3.309,3.309,0,0,1-.6-1.437Zm8.379.306a1.957,1.957,0,0,0-3.253-1.4c-.332.28-.541.289-.855.013a1.949,1.949,0,0,0-2.7,2.812c.987,1.01,2,2,2.99,3,.1.1.156.1.255,0,.995-1,2-2,2.992-3A2,2,0,0,0,3109.927,646.2Zm11.475-13.323a1.1,1.1,0,0,0,1.1,1.126,1.12,1.12,0,0,0,1.108-1.1,1.106,1.106,0,0,0-1.091-1.108A1.09,1.09,0,0,0,3121.4,632.872Z" transform="translate(0 0)" fill="#4e4e4e"/>
					<path id="Path_584" data-name="Path 584" d="M3227.53,756.868a4.714,4.714,0,1,1,4.709-4.726A4.722,4.722,0,0,1,3227.53,756.868Zm-3.715-4.713a3.711,3.711,0,1,0,3.715-3.712A3.716,3.716,0,0,0,3223.815,752.155Z" transform="translate(-113.139 -113.035)" fill="#4e4e4e"/>
					<path id="Path_585" data-name="Path 585" d="M3295.654,811.263a9.457,9.457,0,0,1-9.364,9.035.515.515,0,0,1-.583-.486.5.5,0,0,1,.551-.513,8.49,8.49,0,0,0,8.4-8.127c.007-.133.006-.268.022-.4a.487.487,0,0,1,.472-.436.5.5,0,0,1,.5.378A2.213,2.213,0,0,1,3295.654,811.263Z" transform="translate(-171.82 -171.717)" fill="#4e4e4e"/>
					<path id="Path_586" data-name="Path 586" d="M3293.281,811.138a7.043,7.043,0,0,1-7,6.774c-.35,0-.572-.187-.578-.485a.507.507,0,0,1,.558-.514,5.677,5.677,0,0,0,2.563-.6,5.989,5.989,0,0,0,3.457-5.329,1.4,1.4,0,0,1,.036-.3.492.492,0,0,1,.964.1C3293.289,810.9,3293.281,811.022,3293.281,811.138Z" transform="translate(-171.816 -171.712)" fill="#4e4e4e"/>
					<path id="Path_587" data-name="Path 587" d="M3405.886,931.025a.5.5,0,0,1-.492-.5.487.487,0,0,1,.511-.5.5.5,0,0,1,.486.5A.517.517,0,0,1,3405.886,931.025Z" transform="translate(-283.489 -283.388)" fill="#4e4e4e"/>
					<path id="Path_588" data-name="Path 588" d="M3261.035,787.989a2.306,2.306,0,1,1,2.322-2.3A2.314,2.314,0,0,1,3261.035,787.989Zm1.319-2.3a1.3,1.3,0,1,0-1.312,1.3A1.308,1.308,0,0,0,3262.354,785.685Z" transform="translate(-146.665 -146.563)" fill="#4e4e4e"/>
				</g>
			</svg>

			<span>Album cover</span>
            @if(count($album_covers_unapproved)>0)
			<span class="counter">{{ count($album_covers_unapproved) }}</span>
            @endif
		</a>
		<a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-art" role="tab" aria-controls="nav-contact" aria-selected="false">
			<svg xmlns="http://www.w3.org/2000/svg" width="22.099" height="24.757" viewBox="0 0 22.099 24.757">
				<g id="Group_406" data-name="Group 406" transform="translate(-3774.234 -498.638)">
					<path id="Path_589" data-name="Path 589" d="M3793.195,498.638a.894.894,0,0,1,.369.367,19.968,19.968,0,0,1,1.724,3.341,2.326,2.326,0,0,1-.4,2.463c-.125.149-.011.19.07.257a9.018,9.018,0,0,1,1.993,2.188,4.483,4.483,0,0,1,.785,2.715,2.646,2.646,0,0,1-.866,1.977,2.265,2.265,0,0,1-1.642.511c-.2-.011-.255.049-.252.251a53.585,53.585,0,0,1-.239,5.962,17.246,17.246,0,0,1-.627,3.512,2.863,2.863,0,0,1-.359.788.789.789,0,0,1-1.406-.007,4.764,4.764,0,0,1-.6-1.7,33.32,33.32,0,0,1-.581-5.519c-.03-.708-.034-1.418-.052-2.126,0-.045.019-.1-.042-.151a4.631,4.631,0,0,0-1.314,1.539,5.017,5.017,0,0,0-.552,2.827,4.586,4.586,0,0,1-2.061,4.456,4.638,4.638,0,0,1-4.434.476,10.482,10.482,0,0,1-6.959-8.467c-.016-.087-.019-.176-.03-.264a.493.493,0,0,1,.392-.6.475.475,0,0,1,.554.44,9.718,9.718,0,0,0,.667,2.537,9.513,9.513,0,0,0,5.857,5.494,3.8,3.8,0,0,0,4.767-2,4.25,4.25,0,0,0,.285-2.036,5.717,5.717,0,0,1,2.726-5.5.316.316,0,0,0,.161-.291c.043-1.393.106-2.785.273-4.17a17.953,17.953,0,0,1,.411-2.377.242.242,0,0,0-.122-.313,2.319,2.319,0,0,1-.931-1.256.314.314,0,0,0-.175-.238,9.89,9.89,0,0,0-7.688-.317,9.571,9.571,0,0,0-5.963,6.582c-.018.062-.031.125-.05.186a.484.484,0,1,1-.934-.249,8.593,8.593,0,0,1,.462-1.422,10.518,10.518,0,0,1,8.284-6.562,10.717,10.717,0,0,1,5.736.681c.221.085.293.079.374-.167a16.04,16.04,0,0,1,1.608-3.208,1.577,1.577,0,0,1,.487-.612Zm-.158,23.575a1.069,1.069,0,0,0,.165-.364,13.422,13.422,0,0,0,.477-2.435c.2-1.616.277-3.24.324-4.866.038-1.289,0-2.577-.049-3.864-.008-.195-.054-.263-.267-.232a4.3,4.3,0,0,1-1.252,0c-.23-.034-.283.038-.292.253a50.969,50.969,0,0,0,.424,9.733A7.058,7.058,0,0,0,3793.036,522.213Zm.028-22.167a14.874,14.874,0,0,0-1.409,2.916,1.165,1.165,0,0,0,.029.712,1.45,1.45,0,0,0,1.811.947,1.408,1.408,0,0,0,.932-1.8A15.706,15.706,0,0,0,3793.064,500.046Zm1.313,5.8c.014.1.02.167.032.229a32.871,32.871,0,0,1,.524,4.991c.019.428.011.429.451.423a1.226,1.226,0,0,0,1.215-.785,2.592,2.592,0,0,0,.147-1.306,4.789,4.789,0,0,0-1.217-2.452A7.255,7.255,0,0,0,3794.377,505.851Zm-1.31,3.679c.216-.016.433-.039.649-.047.128,0,.161-.053.149-.177a26.286,26.286,0,0,0-.489-3.436c-.029-.125-.043-.262-.234-.222-.157.033-.357-.093-.422.2a28.523,28.523,0,0,0-.487,3.461c-.01.109.014.155.134.168C3792.6,509.506,3792.833,509.518,3793.067,509.53Z" transform="translate(-1.411)" fill="#4e4e4e"/>
					<path id="Path_590" data-name="Path 590" d="M3963.482,616.133a1.933,1.933,0,1,1,1.931,1.942A1.938,1.938,0,0,1,3963.482,616.133Zm1.925-.958a.966.966,0,1,0,.974.958A.969.969,0,0,0,3965.407,615.175Z" transform="translate(-180.063 -109.961)" fill="#4e4e4e"/>
					<path id="Path_591" data-name="Path 591" d="M3857.768,665.958a1.933,1.933,0,1,1-1.931-1.941A1.939,1.939,0,0,1,3857.768,665.958Zm-1.935-.974a.966.966,0,1,0,.968.965A.969.969,0,0,0,3855.833,664.984Z" transform="translate(-75.801 -157.352)" fill="#4e4e4e"/>
					<path id="Path_592" data-name="Path 592" d="M3827.884,785.5a1.933,1.933,0,1,1-1.932-1.94A1.939,1.939,0,0,1,3827.884,785.5Zm-.967-.013a.966.966,0,1,0-.96.972A.969.969,0,0,0,3826.917,785.487Z" transform="translate(-47.367 -271.093)" fill="#4e4e4e"/>
					<path id="Path_593" data-name="Path 593" d="M3915.628,863.253a1.933,1.933,0,1,1-1.954,1.918A1.938,1.938,0,0,1,3915.628,863.253Zm.945,1.939a.966.966,0,1,0-.972.961A.969.969,0,0,0,3916.573,865.192Z" transform="translate(-132.672 -346.917)" fill="#4e4e4e"/>
					<path id="Path_594" data-name="Path 594" d="M3775.2,764.138a.482.482,0,1,1-.467-.485A.487.487,0,0,1,3775.2,764.138Z" transform="translate(0 -252.152)" fill="#4e4e4e"/>
				</g>
			</svg>


			<span>Art</span>
            @if(count($arts_unapproved)>0)
            <span class="counter">{{ count($arts_unapproved) }}</span>
            @endif

		</a>
	</div>
	</nav>
<div class="table-responsive-xl">





	<div class="media-content tab-content" id="nav-tabContent">

		<table class="table table-index  tab-pane fade show active"  id="nav-book">
            @if(count($book_unapproved)!=0)
			<thead class="spacer">

				<th>Num.</th>
				<th class="cell-name">Name</th>
				<th class="cell-name">Email</th>
				<th  class="cell-email">Price</th>
				<th class=" cell-date">Status</th>
				<th  >

				</th>
			</thead>
            @endif
			<tbody >
                <?php
                  $book_counter=1;

                  ?>
                  @foreach ($book_unapproved as $book)
                  <tr>
                    <td>{{ $book_counter }}.</td>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->user->email }}</td>
                    <td>{{ $book->cost }} USD</td>
                    <td class=" cell-date"><div>
                        @if ($book->approved==1)
                          <span>Approved</span>
                        @else
                        <span>Unapproved</span>
                        @endif
                    </div></td>

                    <td class="cell-action">
                        <span class="border-left" style="margin-right: 10px;"></span>

                            <select name="" id=""onchange="getval(this,{{ $book->id }});" class="cell-select">
                                <option value="0"@if($book->approved==0) selected @endif>Unapproved</option>
                                <option value="1"@if($book->approved==1) selected @endif>Approved</option>
                            </select>
                            <button type="button" class="pop" data-toggle="modal"
                            data-target="#delete_{{ $book->id }}">
                            <div class="delete">
                                <span>Delete</span>
                                <img src="{{ asset('rwrite/assets/images/admin/homepage/trash-bin.svg') }}" alt="">
                            </div>
                        </button>
                        </td>
                  </tr>
                  <?php
                  $book_counter+=1;

                  ?>
                  <div class="modal fade" id="delete_{{ $book->id }}" tabindex="-1"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body">
                                <p class="text-center">Are you sure you want to delete “{{ $book->title }}”
                                    article?</p>
                            </div>
                            <div class="modal-footer border-0 justify-content-center">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <a href="{!! url('/admin/media/delete', ['id' => $book->id]) !!}" class="btn btn-danger">Delete</a>
                            </div>
                        </div>
                    </div>
                </div>
                  @endforeach


			</tbody>

		</table>
		<table class="table table-index tab-pane fade"  id="nav-article">
            @if(count($articles_unapproved)!=0)
			<thead class="spacer">

				<th>Num.</th>
				<th>Name</th>
				<th>Email</th>
				<th>Price</th>
				<th>Status</th>
				<th></th>
			</thead>
            @endif
			<tbody  id="nav-book">
                <?php
                  $article_counter=1;
                  ?>
                  @foreach ($articles_unapproved as $article)
                <tr>
                    <td>{{ $article_counter }}.</td>
                    <td>{!!Str::limit($article->title, $limit = 50, $end = '...')!!}</td>
                    @if(isset($article->user))
                        <td>{{$article->user->email}}</td>
                        @else
                        <td>{{$article->author}}</td>
                    @endif
                    <td>{{ $article->cost }} USD</td>
                    <td>
                        <div>
                            @if ($article->approved==1)
                            <span>Approved</span>
                            @else
                            <span>Unapproved</span>
                            @endif
                        </div>
                    </td>

                    <td>
                        <span class="border-left" style="margin-right: 10px;"></span>
                        <select name="" id=""onchange="getval(this,{{ $article->id }});" class="cell-select">
                            <option value="0"@if($article->approved==0) selected @endif>Unapproved</option>
                            <option value="1"@if($article->approved==1) selected @endif>Approved</option>
                        </select>
                        <button type="button" class="pop" data-toggle="modal" data-target="#delete_{{ $article->id }}">
                            <div class="delete">
                                <span>Delete</span>
                                <img src="{{ asset('rwrite/assets/images/admin/homepage/trash-bin.svg') }}" alt="">
                            </div>
                        </button>
                    </td>
                </tr>
                  <?php
                  $article_counter+=1;

                  ?>
                  <div class="modal fade" id="delete_{{ $article->id }}" tabindex="-1"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body">
                                <p class="text-center">Are you sure you want to delete “{{ $article->title }}”
                                    article?</p>
                            </div>
                            <div class="modal-footer border-0 justify-content-center">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <a href="{!! url('/admin/media/delete', ['id' => $article->id]) !!}" class="btn btn-danger">Delete</a>
                            </div>
                        </div>
                    </div>
                </div>
                  @endforeach



			</tbody>
		</table>
		<table class="table table-index tab-pane fade"  id="nav-video">
            @if (count($video_films_unapproved)!=0)


			<thead class="spacer">

				<th>Num.</th>
				<th class="cell-name">Name</th>
				<th class="cell-name">Email</th>
				<th  class="cell-email">Price</th>
				<th class=" cell-date">Status</th>
				<th  >

				</th>
			</thead>
            @endif
			<tbody  id="nav-book">
                <?php
                $video_films_counter=1;

                ?>
                @foreach ($video_films_unapproved as $video_film)
                <tr>
                  <td>{{ $video_films_counter }}.</td>
                  <td>{{ $video_film->title }}</td>
                  <td>{{ $video_film->user->email }}</td>
                  <td>{{ $video_film->cost }} USD</td>
                  <td class=" cell-date"><div>
                      @if ($video_film->approved==1)
                        <span>Approved</span>
                      @else
                      <span>Unapproved</span>
                      @endif
                  </div></td>

                  <td class="cell-action">
                      <span class="border-left" style="margin-right: 10px;"></span>

                          <select name="" id=""onchange="getval(this,{{ $video_film->id }});" class="cell-select">
                            <option value="0"@if($video_film->approved==0) selected @endif>Unapproved</option>
                            <option value="1"@if($video_film->approved==1) selected @endif>Approved</option>

                          </select>
                          <button type="button" class="pop" data-toggle="modal"
                                data-target="#delete_{{ $video_film->id }}">
                                <div class="delete">
                                    <span>Delete</span>
                                    <img src="{{ asset('rwrite/assets/images/admin/homepage/trash-bin.svg') }}" alt="">
                                </div>
                            </button>
                      </td>
                </tr>
                <?php
                $video_films_counter+=1;

                ?>
                <div class="modal fade" id="delete_{{ $video_film->id }}" tabindex="-1"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body">
                                <p class="text-center">Are you sure you want to delete “{{ $video_film->title }}”
                                    article?</p>
                            </div>
                            <div class="modal-footer border-0 justify-content-center">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <a href="{!! url('/admin/media/delete', ['id' => $video_film->id]) !!}" class="btn btn-danger">Delete</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach




			</tbody>
		</table>
		<table class="table table-index tab-pane fade"  id="nav-cover">
            @if (count($album_covers_unapproved)!=0)


			<thead class="spacer">

				<th>Num.</th>
				<th class="cell-name">Name</th>
				<th class="cell-name">Email</th>
				<th  class="cell-email">Price</th>
				<th class=" cell-date">Status</th>
				<th  >

				</th>
			</thead>
            @endif
			<tbody  id="nav-book">

                <?php
                $album_covers_counter=1;

                ?>
                @foreach ($album_covers_unapproved as $album_cover)
                <tr>
                  <td>{{ $album_covers_counter }}.</td>
                  <td>{{ $album_cover->title }}</td>
                  <td>{{ $album_cover->user->email }}</td>
                  <td>{{ $album_cover->cost }} USD</td>
                  <td class=" cell-date"><div>
                      @if ($album_cover->approved==1)
                        <span>Approved</span>
                      @else
                      <span>Unapproved</span>
                      @endif
                  </div></td>

                  <td class="cell-action">
                      <span class="border-left" style="margin-right: 10px;"></span>

                          <select name="" id=""onchange="getval(this,{{ $album_cover->id }});" class="cell-select">
                            <option value="0"@if($album_cover->approved==0) selected @endif>Unapproved</option>
                            <option value="1"@if($album_cover->approved==1) selected @endif>Approved</option>
                          </select>
                          <button type="button" class="pop" data-toggle="modal"
                                data-target="#delete_{{ $album_cover->id }}">
                                <div class="delete">
                                    <span>Delete</span>
                                    <img src="{{ asset('rwrite/assets/images/admin/homepage/trash-bin.svg') }}" alt="">
                                </div>
                            </button>
                      </td>
                </tr>
                <?php
                $album_covers_counter+=1;

                ?>
                 <div class="modal fade" id="delete_{{ $album_cover->id }}" tabindex="-1"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body">
                                <p class="text-center">Are you sure you want to delete “{{ $album_cover->title }}”
                                    article?</p>
                            </div>
                            <div class="modal-footer border-0 justify-content-center">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <a href="{!! url('/admin/media/delete', ['id' => $album_cover->id]) !!}" class="btn btn-danger">Delete</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach


				<tr>



			</tbody>
		</table>
		<table class="table table-index tab-pane fade"  id="nav-art">
            @if (count($arts_unapproved)!=0)


			<thead class="spacer">

				<th>Num.</th>
				<th class="cell-name">Name</th>
				<th class="cell-name">Email</th>
				<th  class="cell-email">Price</th>
				<th class=" cell-date">Status</th>
				<th  >

				</th>
			</thead>
            @endif
			<tbody  id="nav-book">


                <?php
                $arts_counter=1;

                ?>
                @foreach ($arts_unapproved as $art)
                <tr>
                  <td>{{ $arts_counter }}.</td>
                  <td>{{ $art->title }}</td>
                  <td>{{ $art->user->email }}</td>
                  <td>{{ $art->cost }} USD</td>
                  <td class=" cell-date"><div>
                      @if ($art->approved==1)
                        <span>Approved</span>
                      @else
                      <span>Unapproved</span>
                      @endif
                  </div></td>

                  <td class="cell-action">
                      <span class="border-left" style="margin-right: 10px;"></span>

                          <select name="" id=""onchange="getval(this,{{ $art->id }});" class="cell-select">
                            <option value="0"@if($art->approved==0) selected @endif>Unapproved</option>
                            <option value="1"@if($art->approved==1) selected @endif>Approved</option>
                          </select>
                          <button type="button" class="pop" data-toggle="modal"
                          data-target="#delete_{{ $art->id }}">
                          <div class="delete">
                              <span>Delete</span>
                              <img src="{{ asset('rwrite/assets/images/admin/homepage/trash-bin.svg') }}" alt="">
                          </div>
                      </button>
                      </td>
                </tr>
                <?php
                $arts_counter+=1;

                ?>
                <div class="modal fade" id="delete_{{ $art->id }}" tabindex="-1"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body">
                                <p class="text-center">Are you sure you want to delete “{{ $art->title }}”
                                    article?</p>
                            </div>
                            <div class="modal-footer border-0 justify-content-center">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <a href="{!! url('/admin/media/delete', ['id' => $art->id]) !!}" class="btn btn-danger">Delete</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach


				<tr>




			</tbody>
		</table>
	</div>
</div>

@endsection
@section('scripts')
<script type="text/javascript">
	setTimeout(function() {
$('#alert-wishlist').fadeOut('fast');
}, 2000);
</script>
<script>
     function getval(sel,id)
         {  let value_selected=sel.value;
            $.ajax({
                  type: 'GET',
                  url: "/admin/changeapprove/"+id+'/'+value_selected,
                  success: function (data) {
                    console.log(value_selected);
                    location.reload();

                       }
        // data: $("#examId").val()
             })
         }
</script>
@endsection

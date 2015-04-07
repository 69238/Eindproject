@extends('layout.default')

@section('content')
	
	<h1>LED-TV</h1>

	<p>
		Met een LED-tv ervaar je een helder en scherp beeld dat films tot leven brengt. Doordat de LED-lampjes weinig ruimte in beslag nemen kijk je altijd naar een ultra dun beeldscherm dat volstaat in elke woonkamer! Daarbij verbruiken ze ook nog eens weinig stroom. Door deze schermen krijg jij dus de mogelijkheid om plezier te beleven als jij naar je lievelingsfilm en -serie aan het kijken bent. Daarnaast ben je ook nog eens milieubewust bezig! De ontwikkeling van LED-tv's gaat maar door en dus krijg je steeds meer mogelijkheden en keuzes. Zo zijn 4K Ultra HD-televisies nog een stuk scherper en hebben diverse merken handige smart-tv systemen.

		Dankzij het groot aantal verschillende formaten beeldschermen is er ook voor jou in huis wel een geschikte televisie te vinden. Jij kiest namelijk zelf alle functies die jij tot je beschikking wilt hebben! Hierdoor kun jij ook gewoon genieten van de allerleukste televisieseries en films. Plezier beleef je zeker. Bestel jouw LED-televisie eenvoudig en snel! Toch nog even wat meer ontdekken? Dat kan door op de verschillende televisies te klikken. Hier vind je namelijk alle informatie die je nodig hebt!
	</p>

	Product Namen:
	
	<table class="table table-hover table-bordered">
		@foreach($producten as $prod)
			@if(!$prod->deleted == '1')
				<tr>
					<td>
						{{ link_to("/producten/{$prod->id}", $prod->naam) }}
					</td>
				</tr>
			@endif
		@endforeach
	</table>

@stop
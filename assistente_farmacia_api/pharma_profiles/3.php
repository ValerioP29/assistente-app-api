<?php
if (!defined('JTA')) {
	header('HTTP/1.0 403 Forbidden');
	exit('Direct access is not permitted.');
}
?>

<app-card>
	<div class="content">

		<!-- HEADER -->
		<div class="text-center my-4">
			<h1 class="fw-bold mb-2 fs-2">Farmacia ai Gemelli</h1>
			<p class="lead text-muted">Una realtà moderna nel cuore di Trieste</p>
		</div>

		<!-- DESCRIZIONE -->
		<h2>Chi siamo</h2>
		<p>
			Benvenuti alla Farmacia ai Gemelli, una realtà moderna e dinamica nel cuore di Trieste.
			Il nostro team si dedica ogni giorno alla salute e al benessere con competenza e umanità.
			Offriamo un punto di riferimento affidabile, unendo consulenza professionale e servizi innovativi.
			Crediamo nella prevenzione e nell’ascolto, con telemedicina e autoanalisi rapide per risposte
			semplici, sicure e vicine a casa.
		</p>

		<!-- SERVIZI / REPARTI -->
		<h2>I nostri reparti e servizi</h2>
		<p>
			<strong>Servizi:</strong> Telemedicina, analisi capillari, servizi infermieristici, fisioterapia,
			nutrizione, logopedia, ostetricia, ottica, servizi a domicilio, centro estetico.<br>
			<strong>Farmacia classica:</strong> integratori, veterinaria, puericultura, dermocosmesi, sanitaria.
		</p>

		<!-- ORARI -->
		<button class="accordion" id="pharmaOrari">Orari di apertura</button>
		<div class="panel">
			<table>
				<thead>
					<tr style="background-color: #f2f2f2;">
						<th>Giorno</th>
						<th>Orario</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>Lunedì</td>
						<td>08:30 – 19:30</td>
					</tr>
					<tr>
						<td>Martedì</td>
						<td>08:30 – 19:30</td>
					</tr>
					<tr>
						<td>Mercoledì</td>
						<td>08:30 – 19:30</td>
					</tr>
					<tr>
						<td>Giovedì</td>
						<td>08:30 – 19:30</td>
					</tr>
					<tr>
						<td>Venerdì</td>
						<td>08:30 – 19:30</td>
					</tr>
					<tr>
						<td>Sabato</td>
						<td>08:30 – 19:30</td>
					</tr>
					<tr>
						<td>Domenica</td>
						<td>10:00 – 19:30</td>
					</tr>
				</tbody>
			</table>
		</div>

		<!-- TURNI -->
		<button class="accordion" id="pharmaTurni">Calendario turni</button>
		<div class="panel">
			<div id="turni-calendar" class="mt-2"></div>
		</div>

		<!-- NOTA SERVIZI DINAMICI -->
		<button class="accordion" id="pharmaService">I nostri servizi</button>
		<div class="panel">
			<p class="mb-0 text-muted">
				I servizi disponibili possono variare in base alla giornata.
				Consulta la sezione Servizi dell’app per prenotare o richiedere informazioni dettagliate.
			</p>
		</div>

	</div>
</app-card>

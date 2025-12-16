<?php
	session_start();

	$success = null;
	$error = null;
	$users = NULL;
	if( isset($_SESSION['poipoipoi']) && $_SESSION['poipoipoi'] == 654 ){
echo 'Inserisci da codice pagina il nuovo testo da inviare';
exit;

		require_once('../_api_bootstrap.php');
		require_once('../helpers/_model_comm_history.php');

		$pharma = get_pharma_by_id(1);
		if( ! $pharma ) exit('Farmacia non trovata');

		$users = get_users_by_pharma($pharma['id']);
		if( isset($users) ){
			// Rimuovo gli utenti registrati in fiera Puglia
			$users = array_filter($users, function($_user){ return $_user['ref'] != 'fiera'; });
			// $users = array_filter($users, function($_user){ return $_user['is_tester'] === 1; });

			$users = array_map('normalize_user_data', $users);
			// Tengo solo i maschi oppure solo le femmine
			// $users = array_filter($users, function($_user){ return $_user['has_profiling'] && $_user['init_profiling']['genere'] == 'Maschio'; });
			// $users = array_filter($users, function($_user){ return $_user['has_profiling'] && $_user['init_profiling']['genere'] == 'Femmina'; });

			$user_ids = array_values(array_column($users, 'id'));
		}else{
			$user_ids = [1]; // Per Test
			// $user_ids = [1, 2]; // Per Test
			// $user_ids = [1, 4]; // Per Test
		}

print("<pre>"); print_r($user_ids); print("</pre>");
exit;

		$text = "💚 Benessere gola: quanto ne sai davvero?\nTi basta 1 minuto per scoprirlo.\n\nRispondi alle 5 domande del quiz e verifica se ti stai prendendo cura della tua gola nel modo corretto.\n\n📲 Partecipa qui:\nhttps://app.assistentefarmacia.it/sondaggio.html.\n\nUn piccolo gesto oggi ti evita grandi fastidi domani. 💪";

		// 20251208 ALL (SURVEY #6) // $text = "💚 Benessere gola: quanto ne sai davvero?\nTi basta 1 minuto per scoprirlo.\n\nRispondi alle 5 domande del quiz e verifica se ti stai prendendo cura della tua gola nel modo corretto.\n\n📲 Partecipa qui:\nhttps://app.assistentefarmacia.it/sondaggio.html.\n\nUn piccolo gesto oggi ti evita grandi fastidi domani. 💪";
		// 20251128 ALL (SURVEY #5) // $text = "🌞 Vitamina D: quanto ne sai davvero?\nTi basta 1 minuto per scoprirlo.\n\nRispondi alle 5 domande del quiz e verifica se stai assumendo la vitamina D nel modo corretto.\n\n📲 Partecipa qui:\nhttps://app.assistentefarmacia.it/sondaggio.html\n\nVuoi un check ancora più preciso?\nNell’app potrai prenotare l'evento per il Test gratuito della Vitamina D e ricevere supporto dalla biologa qualificata. 💪💚";
		// 20251117 ALL (SURVEY #4) // $text = "💧 Naso libero in 1 minuto!\nMetti alla prova le tue conoscenze con il quiz e scopri se stai seguendo le buone pratiche per un respiro sano. 👃\n\n📲 Partecipa qui:\nhttps://app.assistentefarmacia.it/sondaggio.html\n\nPiccole abitudini oggi migliorano il tuo benessere respiratorio domani.";
		// 20251110 ALL (SURVEY #3) // $text = "👂 Benessere delle orecchie!\nBastano 60 secondi per scoprirlo.\n\nRispondi alle 5 domande del nostro mini test e scopri se stai eseguendo le buone pratiche per una corretta igiene auricolare.\n\nPartecipa ora al sondaggio cliccando qui: https://app.assistentefarmacia.it/sondaggio.html?id=3\n\nUn piccolo gesto oggi protegge il tuo benessere domani.";
		// 20251103 ALL // $text = "🧴 *SOS Pelle d’Inverno!*\nScoprilo in 60 secondi!\n\nRispondi alle 5 domande del nostro mini test, alla fine scoprirai il tuo profilo di protezione.\n\n📲 Partecipa ora al sondaggio cliccando qui: https://app.assistentefarmacia.it/sondaggio.html?id=2\n\nUn piccolo gesto oggi ti evita grandi fastidi domani. 💪";
		// 20251028 ALL // $text = "🛡️ Sei protetto dall’influenza?\nScoprilo in 60 secondi!\n\nRispondi alle 5 domande del nostro mini test, alla fine scoprirai il tuo profilo di prevenzione.\n\n📲 Partecipa ora al sondaggio cliccando qui: https://app.assistentefarmacia.it/sondaggio.html?id=1\n\nUn piccolo gesto oggi ti evita grandi fastidi domani. 💪";
		// 20251017 SELECTED SURVEY // $text = "Grazie per aver partecipato al nostro sondaggio! 🙌\nTi abbiamo accreditato 10 punti benessere sul tuo profilo 💚\nContinua ad usare l'app, presto arriveranno tante novità pensate per te! 🌿";
		// 20251015 ALL // $text = "Buongiorno dalla tua Farmacia Giovinazzi 👩🏻‍⚕️💊🤗\nAbbiamo preparato un breve sondaggio per conoscere meglio le tue opinioni riguardo la nostra AssistenteFarmacia.\n\n💚 Compilandolo riceverai 10 punti benessere in omaggio!\n\n👉 Ti bastano pochi minuti, partecipa qui:\nhttps://forms.gle/fBmjcmP4mQSDQk7P8\n\nIl tuo parere ci aiuterà a migliorare il servizio e renderlo sempre più utile. 🌿";
		// 20251010 DONNE // $text = "💄 Novità BioNike: il make-up raddoppia!\n\nDa Farmacia Giovinazzi, per tutto il mese, un’occasione dedicata alla tua bellezza:\n\n🖌️ Scegli 2 prodotti make-up BioNike\n💝 Il meno caro è in omaggio!\n\nUn'opportunità perfetta per rinnovare il tuo beauty case con prodotti dermatologicamente testati, ideali anche per le pelli più sensibili.\n\n📲 Prenotala ora tramite la nostra App:\n👉 https://app.assistentefarmacia.it/promozioni.html?tipo=bionike-1-1\n\n📦 Fino ad esaurimento scorte. Affrettati!";
		// 20251009 ALL // $text = "Buongiorno dalla tua Farmacia Giovinazzi 👩🏻‍⚕️🩺💞. Ottobre Rosa è il mese della prevenzione per il tumore al seno anche la nostra farmacia partecipa alla campagna Nastro Rosa promossa dalla Fondazione AIRC con una donazione minima di 2 euro riceverai una spilletta a forma di nastro rosa per sostenere la ricerca, puoi fare molto con la prevenzione per ottenere un grande traguardo.\n\nPrenotala subito tramite la nostra App prima che terminino e ritirala quando preferisci.\nhttps://app.assistentefarmacia.it/promozioni.html?tipo=ottobre-rosa";
		// 20250919 ALL // // $text = "Buongiorno dalla tua Farmacia Giovinazzi 👩🏻‍⚕️ 💊 🤗 venerdì 19 settembre dalle 16:30 alle 19:00 in farmacia ci sarà una consulenza tricologica gratuita.\n\nSi tratta di una valutazione personalizzata di cuoio capelluto e capelli, utile per affrontare problemi come caduta, forfora, diradamento o capelli danneggiati.\n\nDurante l’incontro riceverai:\n✔️ una valutazione gratuita\n✔️ l’analisi delle cause principali\n✔️ consigli mirati con soluzioni su misura\n\n👉 Posti limitati (max 5 persone).\nPrenota la tua consulenza sull'app https://app.assistentefarmacia.it/eventi.html?id=10";
		// 20250926 UOMO // // $text = "Buongiorno dalla tua Farmacia Giovinazzi 👩🏻‍⚕️ 💊 🤗 venerdì 3 ottobre dalle 16:30 alle 19:00 in farmacia ci sarà una consulenza tricologica gratuita.\n\nSi tratta di una valutazione personalizzata di cuoio capelluto e capelli, un appuntamento dedicato soprattutto agli uomini che vogliono affrontare problemi come caduta, forfora, diradamento o capelli danneggiati.\n\nDurante l’incontro riceverai:\n✔️ una valutazione gratuita\n✔️ l’analisi delle cause principali\n✔️ consigli mirati con soluzioni su misura\n\n👉 Posti limitati (max 5 persone).\nPrenota la tua consulenza sull’app https://app.assistentefarmacia.it/eventi.html?id=12";
		// 20250926 DONNA // // $text = "🌸 *Benessere e Cura della Pelle con BioNike* 🌸\n\nPrenditi cura di te con il nostro *consiglio di bellezza* di oggi: *la cura quotidiana della pelle è fondamentale* per mantenere il tuo viso fresco e luminoso! 💆🏻‍♀️\n\n*Il trattamento giusto per te?*\nProva il *Kit BioNike Defence My Age Pearl*, ideale per contrastare i segni del tempo e rivitalizzare la pelle. Con una *crema giorno*, una *crema notte* e un *siero intensivo*, il tuo viso sarà rigenerato e più luminoso ogni giorno!\n\n✨ *Solo per oggi*: approfitta della *promo esclusiva* e acquista il Kit con *50€ di sconto*, portando a casa il tutto a soli *81,70€* (anziché 131,70€)\n\n*In più*: prenotando tramite l’app oggi, riceverai *50 punti extra* e *la consegna gratuita* direttamente a casa! 🚚🎁\n\n💬 Prenota ora sull’app 👉 https://app.assistentefarmacia.it/promozioni.html?id=7093";

		$datetime = date('Y-m-d H:i:s', strtotime('+5 minutes'));
		// $datetime = date('Y-m-d H:i:s', strtotime('+2 minutes'));
		// $datetime = date('2025-11-10 10:00:00');

		// 1 invio al minuti,
		// date di schedulazioni a gruppi di 15
		// poi 15min di pausa (15min per i 15 invii + 15min di pausa = chunk_gap = 30min)
		$options = [
			'chunk' => 15,
			'chunk_gap' => (60 * (15 + 15)),
		];
		$resp = CommModel::scheduleWa($pharma['id'], $user_ids, $text, $datetime, $options);

		unset($_SESSION['poipoipoi']);

		echo 'Codice gruppo: ' . $resp . '<br>';
		echo 'Numero di destinatari: ' . count($user_ids) . '<br>';
		echo 'Invii a partire da: ' . $datetime;
		exit;
	}else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		$psw = $_POST['password'] ?? FALSE;
		if ( $psw && $psw == 'jta25' ) {
			$_SESSION['poipoipoi'] = 654;
			header('Location: ' . $_SERVER['PHP_SELF']);
			exit;
		}
	}

?><!DOCTYPE html>
<html lang="it">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />
	<meta name="robots" content="noindex, nofollow" />

	<title>Assistente</title>
	<style>
		*, *:before, *:after{ margin: 0; padding: 0; box-sizing: border-box; }
		body { font-family: sans-serif; margin: 2em 0; }
		form { max-width: 800px; margin-top: 2em; }
		label { display: block; margin-top: 1em; }
		input[type="text"], input[type="date"], input[type="number"], input[type="password"], select {
			width: 100%; padding: 0.5em; font-size: 1em;
		}
		button { margin-top: 1.5em; padding: 0.6em 1.2em; font-size: 1em; }
		.message { margin-top: 1em; font-weight: bold; }
		.container { width: 100%; max-width: 400px; padding: 0 8px; margin: 0 auto; }
		.success { color: green; }
		.error { color: red; }
		ol, ul{
			margin-top: 24px;
			text-indent: 0;
			padding-left: 16px;
		}
		td,th{
			padding: 5px 5px;
		}
		table{
			margin-top: 24px;
		}
		table, th, td {
			border-collapse: collapse;
			border: 1px solid black;
		}

		th {
			cursor: pointer;
			user-select: none;
			position: relative;
			padding-right: 18px;
		}
		th .sort-icon {
			position: absolute;
			right: 4px;
			font-size: 0.8em;
		}
	</style>
</head>
<body>
	<div class="container">
		<?php if ($success): ?>
			<div class="message success"><?= $success ?></div>
		<?php elseif ($error): ?>
			<div class="message error"><?= $error ?></div>
		<?php endif; ?>

		<form method="POST">
			<label for="password">Password:</label>
			<input type="password" id="password" name="password" required>
			<button type="submit">Accedi</button>
		</form>
	</div>
</body>
</html>
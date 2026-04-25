<h2>Neue Audition-Anmeldung</h2>

<p><strong>Name:</strong>
  <?= esc($data['vorname']) ?> <?= esc($data['nachname']) ?>
</p>

<p><strong>Geburtsdatum:</strong> <?= esc($data['geburtsdatum']) ?></p>
<p><strong>Email:</strong> <?= esc($data['email']) ?></p>
<p><strong>Telefon:</strong> <?= esc($data['telefon'] ?? '-') ?></p>

<p><strong>Audition Auswahl:</strong><br>
  <?= esc(implode(', ', $audition_selection ?? [])) ?>
</p>

<p><strong>Erfahrung:</strong><br>
  <?= esc(implode(', ', $erf_mog_list ?? [])) ?>
</p>

<p><strong>Zusätzliche Fähigkeiten:</strong><br>
  <?= nl2br(esc($zusatzliche_fahigkeiten ?? 'Keine')) ?>
</p>
<tr class="">

    <th>Name</th>
    <th>Age</th>
    <th>Phone</th>
    <th>Has Song</th>
    <th>Actions</th>

</tr>

<?php foreach($data as $patient): ?>

    <tr class="patient_row">

        <td class="patient-name"><?php echo $patient->patient_name; ?></td>
        <td class="patient-age"><?php echo $patient->patient_age; ?></td>
        <td class="patient-phone"><?php echo $patient->patient_phone; ?></td>
        <td class="patient-has-song">
            <?php echo empty($patient->favorite_song_id) ? 'NO' : 'YES'; ?>
        </td>

        <td class="patient-song">
            <a href="index.php?action=assign_song&patient_id=<?= $patient->patient_id ?>" title="Click to assign a song to <?= $patient->patient_name ?>">Assign Song</a>
        </td>

    </tr>

<?php endforeach; ?>

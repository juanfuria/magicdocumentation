
<?php foreach ($json["parameters"] as $param): ?>
    <tr>
        <td><?=$param["name"]?></td>
        <td><?=$param["type"]?></td>
        <td><?=$param["validation"]?></td>
        <td><?=$param["notes"]?></td>
    </tr>
<?php endforeach ?>
<!doctype html>
<html>
<head>
	<meta charset=utf-8>
	<title><?=$name?> * wiki.zick.io</title>
	<link rel="stylesheet" href="/src/wiki.css">
</head>

<body>
<p class=msg>
<?= $error ?>
<?= $alert ?>
<?= $notice ?>
</p>
<a href=/ class=back>&larr; all pages</a>

<hgroup>
	<h1> <?=$name?> </h1>
    <?php if ($version > 0): ?>
        <a href="/<?=$name?>~<?=$version-1?>">&lt;</a>
    <?php endif; ?>
    v<?=$version?>
    <?php if ($newer): ?>
        <a href="/<?=$name?>~<?=$version+1?>">&gt;</a>
    <?php endif; ?>
    <?php if (!empty($head['author'])): ?>
        | ~<?=$head['author']?><?php if (!empty($head['summary'])): ?>: <?=$head['summary']?> <?php endif; ?>
    <?php endif; ?>
    | <time datetime="<?=$time?>" type="relative"><?=rtime($time)?></time>
    | <a class=edit href="/:<?=$name?>">Edit</a>
</hgroup>

<?php echo $file; ?>

<script src="/src/moment.min.js"></script>
<script>
var x = document.getElementsByTagName('time')[0],
    d = moment.unix(x.getAttribute('datetime'));

function setTime() {
    var stime = d.format("D MMM YYYY h:mma");
        rtime = d.fromNow();

    if (x.getAttribute('type') == 'relative') {
        x.setAttribute('title', stime);
        x.innerHTML = rtime;
    } else {
        x.setAttribute('title', rtime);
        x.innerHTML = stime;
    }
}
setTime();
setInterval(setTime, 2000);

x.onclick = function() {
    if (this.getAttribute('type') == 'relative')
        this.setAttribute('type', 'static');
    else
        this.setAttribute('type', 'relative');

    setTime();
}
</script>

</body>
</html>

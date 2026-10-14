<?php
// PHP-host version: /logo.php
// Always redirects to your CURRENT Discord avatar (fetched live from Lanyard).
$id = '1454733327822225470';
$url = 'https://cdn.discordapp.com/embed/avatars/0.png';
$ctx = stream_context_create(['http' => ['timeout' => 5]]);
$raw = @file_get_contents("https://api.lanyard.rest/v1/users/$id", false, $ctx);
if ($raw) {
  $j = json_decode($raw, true);
  $u = $j['data']['discord_user'] ?? null;
  if ($u && !empty($u['avatar'])) $url = "https://cdn.discordapp.com/avatars/{$u['id']}/{$u['avatar']}.png?size=256";
}
header('Cache-Control: public, max-age=3600');
header('Location: ' . $url, true, 302);

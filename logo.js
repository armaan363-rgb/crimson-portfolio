// Vercel / Netlify-style serverless function: /api/logo
// Always redirects to your CURRENT Discord avatar (fetched live from Lanyard).
const ID = '1454733327822225470';

export default async function handler(req, res) {
  let url = 'https://cdn.discordapp.com/embed/avatars/0.png';
  try {
    const r = await fetch('https://api.lanyard.rest/v1/users/' + ID);
    const j = await r.json();
    const u = j.data && j.data.discord_user;
    if (u && u.avatar) url = `https://cdn.discordapp.com/avatars/${u.id}/${u.avatar}.png?size=256`;
  } catch (e) {}
  res.setHeader('Cache-Control', 's-maxage=3600, stale-while-revalidate=86400');
  res.redirect(302, url);
}

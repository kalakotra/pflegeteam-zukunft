"""Build Pflegeteam Zukunft logo concepts as SVG (text converted to paths)."""
from fontTools.ttLib import TTFont
from fontTools.pens.svgPathPen import SVGPathPen
from fontTools.pens.transformPen import TransformPen
import cairosvg, sys, os

FS = 'node_modules/@fontsource'
fonts = {
    'outfit600': TTFont(f'{FS}/outfit/files/outfit-latin-600-normal.woff2'),
    'outfit700': TTFont(f'{FS}/outfit/files/outfit-latin-700-normal.woff2'),
    'figtree500': TTFont(f'{FS}/figtree/files/figtree-latin-500-normal.woff2'),
}

BLUE, RED, INK, WHITE = '#007FA3', '#D71433', '#0E2A36', '#FFFFFF'


def text_path(txt, font, size, x, y, tracking=0.0):
    f = fonts[font]
    upm = f['head'].unitsPerEm
    gs = f.getGlyphSet(); cmap = f.getBestCmap(); hmtx = f['hmtx']
    s = size / upm
    pen = SVGPathPen(gs)
    cx = 0.0
    for ch in txt:
        g = cmap.get(ord(ch))
        if g is None:
            continue
        tp = TransformPen(pen, (s, 0, 0, -s, x + cx, y))
        gs[g].draw(tp)
        cx += hmtx[g][0] * s + tracking * size
    return pen.getCommands(), cx - tracking * size


def mark_a(c_tube=BLUE, c_piece=RED, c_inner=WHITE):
    """Stethoscope tubing forms a heart; chestpiece carries a small heart."""
    return f'''
  <g fill="none" stroke="{c_tube}" stroke-width="7" stroke-linecap="round" stroke-linejoin="round">
    <path d="M43 21 C39 10 23 6 14 17 C3 31 15 53 50 79"/>
    <path d="M57 21 C61 10 77 6 86 17 C97 31 85 53 50 79"/>
    <path d="M50 79 C50 91 55 97 63 97 C72 97 77 91 77 84"/>
  </g>
  <circle cx="43.6" cy="21.8" r="4.2" fill="{c_tube}"/>
  <circle cx="56.4" cy="21.8" r="4.2" fill="{c_tube}"/>
  <circle cx="77" cy="74" r="11" fill="{c_piece}"/>
  <path d="M77 80.2 C73.6 77.6 71 75.4 71 72.4 C71 70.4 72.6 68.9 74.4 68.9 C75.6 68.9 76.5 69.6 77 70.5 C77.5 69.6 78.4 68.9 79.6 68.9 C81.4 68.9 83 70.4 83 72.4 C83 75.4 80.4 77.6 77 80.2Z" fill="{c_inner}"/>'''


def mark_b(c1=BLUE, c2=RED):
    """Two people leaning together; their bodies form a heart."""
    return f'''
  <circle cx="34" cy="22" r="10" fill="{c1}"/>
  <circle cx="66" cy="22" r="10" fill="{c2}"/>
  <path d="M50 92 C34 80 12 64 12 46 C12 38 18 34 24 36 C32 39 38 48 50 56 Z" fill="{c1}"/>
  <path d="M50 92 C66 80 88 64 88 46 C88 38 82 34 76 36 C68 39 62 48 50 56 Z" fill="{c2}"/>'''



def mark_c(c_tube=BLUE, c_piece=RED, c1=BLUE, c2=RED, c_dot=WHITE, s=0.56):
    """A + B combined: stethoscope heart holding two people; plain chestpiece."""
    inner = mark_b(c1, c2)
    return f'''
  <g fill="none" stroke="{c_tube}" stroke-width="7" stroke-linecap="round" stroke-linejoin="round">
    <path d="M43 21 C39 10 23 6 14 17 C3 31 15 53 50 79"/>
    <path d="M57 21 C61 10 77 6 86 17 C97 31 85 53 50 79"/>
    <path d="M50 79 C50 91 55 97 63 97 C72 97 77 91 77 84"/>
  </g>
  <circle cx="43.6" cy="21.8" r="4.2" fill="{c_tube}"/>
  <circle cx="56.4" cy="21.8" r="4.2" fill="{c_tube}"/>
  <circle cx="77" cy="74" r="10" fill="{c_piece}"/>
  <circle cx="77" cy="74" r="4" fill="{c_dot}"/>
  <g transform="translate(50 50.5) scale({s}) translate(-50 -52)">{inner}</g>'''

def lockup(mark, name, mono=None, dark=False):
    ink = WHITE if dark else INK
    blue = '#5FC3E4' if dark else BLUE
    if mono:
        ink = blue = mono
    d1, w1 = text_path('Pflegeteam', 'outfit600', 46, 0, 0)
    d2, w2 = text_path('Zukunft', 'outfit700', 46, 0, 0)
    d3, w3 = text_path('AMBULANTER PFLEGEDIENST · HAMBURG', 'figtree500', 11.5, 0, 0, tracking=0.12)
    tx = 118
    W = tx + max(w1, w2, w3) + 4
    m = mark if not dark else mark.replace(BLUE, '#5FC3E4')
    if mono:
        m = m.replace(BLUE, mono).replace(RED, mono)
    svg = f'''<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 {W:.0f} 104" role="img" aria-labelledby="t">
  <title id="t">Pflegeteam Zukunft – Ambulanter Pflegedienst Hamburg</title>
  <g transform="translate(2 2)">{m}
  </g>
  <path transform="translate({tx} 44)" fill="{ink}" d="{d1}"/>
  <path transform="translate({tx} 86)" fill="{blue}" d="{d2}"/>
  <path transform="translate({tx + 2} 102)" fill="{ink}" fill-opacity="{0.9 if dark else 0.72}" d="{d3}"/>
</svg>'''
    return svg


def icon(mark, size=104, bg=None, pad=0, rx=0):
    bgel = f'<rect width="104" height="104" rx="{rx}" fill="{bg}"/>' if bg else ''
    return f'<svg xmlns="http://www.w3.org/2000/svg" viewBox="{-pad} {-pad} {104 + 2 * pad} {104 + 2 * pad}">{bgel}<g transform="translate(2 2)">{mark}</g></svg>'


os.makedirs('out', exist_ok=True)
files = {
    'c-logo.svg': lockup(mark_c(), 'c'),
    'c-logo-light.svg': lockup(mark_c(c_tube='#5FC3E4', c1='#5FC3E4', c2='#FF6B7D'), 'c', dark=True),
    'c-mark.svg': icon(mark_c()),
    'c-favicon.svg': icon(mark_c(c_tube=WHITE, c1=WHITE, c2='#FFD1D8', c_piece=RED, c_dot=WHITE, s=0.55), bg=BLUE, pad=6, rx=22),
    'c-favicon-small.svg': icon(mark_b(WHITE, '#FFD1D8'), bg=BLUE, pad=10, rx=22),
    'a-logo.svg': lockup(mark_a(), 'a'),
    'a-logo-light.svg': lockup(mark_a(c_tube='#5FC3E4'), 'a', dark=True),
    'a-mark.svg': icon(mark_a()),
    'a-favicon.svg': icon(mark_a(c_tube=WHITE, c_piece=RED, c_inner=WHITE), bg=BLUE, pad=6, rx=22),
    'b-logo.svg': lockup(mark_b(), 'b'),
    'b-logo-light.svg': lockup(mark_b(c1='#5FC3E4', c2='#FF6B7D'), 'b', dark=True),
    'b-mark.svg': icon(mark_b()),
    'b-favicon.svg': icon(mark_b(c1=WHITE, c2=WHITE), bg=BLUE, pad=10, rx=22),
}
for n, s in files.items():
    open(f'out/{n}', 'w').write(s)

# preview sheet
from xml.etree import ElementTree as ET
sheet = ['<svg xmlns="http://www.w3.org/2000/svg" width="1200" height="760" viewBox="0 0 1200 760">',
         '<rect width="1200" height="760" fill="#F4F7F8"/>',
         '<rect x="0" y="380" width="1200" height="380" fill="#0E2A36"/>']
def embed(svg, x, y, w):
    root = ET.fromstring(svg)
    vb = root.get('viewBox')
    inner = svg.split('>', 1)[1].rsplit('</svg>', 1)[0]
    return f'<svg x="{x}" y="{y}" width="{w}" viewBox="{vb}" overflow="visible">{inner}</svg>'
sheet += [embed(files['a-logo.svg'], 40, 60, 520), embed(files['b-logo.svg'], 640, 60, 520),
          embed(files['a-favicon.svg'], 40, 250, 96), embed(files['a-favicon.svg'], 156, 274, 48), embed(files['a-favicon.svg'], 224, 290, 32), embed(files['a-favicon.svg'], 276, 298, 16),
          embed(files['b-favicon.svg'], 640, 250, 96), embed(files['b-favicon.svg'], 756, 274, 48), embed(files['b-favicon.svg'], 824, 290, 32), embed(files['b-favicon.svg'], 876, 298, 16),
          embed(files['a-logo-light.svg'], 40, 460, 520), embed(files['b-logo-light.svg'], 640, 460, 520),
          '<text x="40" y="36" font-family="sans-serif" font-size="18" fill="#4F5B62">A · Stethoskop-Herz</text>',
          '<text x="640" y="36" font-family="sans-serif" font-size="18" fill="#4F5B62">B · Team-Herz</text>']
sheet.append('</svg>')
open('out/sheet.svg', 'w').write('\n'.join(sheet))
cairosvg.svg2png(url='out/sheet.svg', write_to='out/sheet.png', output_width=1200)
print('ok')

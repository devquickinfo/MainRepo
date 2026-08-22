<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>ID Card Editor — Mother's Pride School</title>
<style>
  :root{
    --maroon:#9e1b32;
    --maroon-dark:#7a1526;
    --gold:#e8b84b;
    --ink:#1f2430;
    --muted:#6b7280;
    --line:#e5e7eb;
    --panel-bg:#ffffff;
    --bg:#f2f3f5;
    --accent:#2f6fed;
  }
  *{box-sizing:border-box;}
  body{
    margin:0;
    font-family:'Segoe UI',Arial,sans-serif;
    background:var(--bg);
    color:var(--ink);
  }
  .topbar{
    background:var(--maroon);
    color:#fff;
    padding:14px 24px;
    display:flex;
    align-items:center;
    justify-content:space-between;
    box-shadow:0 2px 8px rgba(0,0,0,.15);
  }
  .topbar h1{
    font-size:17px;
    margin:0;
    font-weight:700;
    letter-spacing:.2px;
  }
  .topbar .sub{
    font-size:12px;
    opacity:.85;
    margin-top:2px;
    font-weight:400;
  }
  .topbar button{
    background:var(--gold);
    color:#3a2a00;
    border:none;
    padding:9px 16px;
    border-radius:6px;
    font-weight:700;
    font-size:13px;
    cursor:pointer;
  }
  .topbar button:hover{filter:brightness(1.05);}

  .editor{
    display:flex;
    gap:24px;
    padding:24px;
    align-items:flex-start;
    flex-wrap:wrap;
  }

  /* =========== LEFT CONTROLS =========== */
  .controls{
    width:340px;
    max-height:calc(100vh - 100px);
    overflow-y:auto;
    background:var(--panel-bg);
    border-radius:10px;
    box-shadow:0 2px 10px rgba(0,0,0,.08);
    padding:6px 0 16px;
    flex-shrink:0;
  }
  .group{
    border-bottom:1px solid var(--line);
    padding:14px 18px;
  }
  .group:last-child{border-bottom:none;}
  .group-title{
    display:flex;
    align-items:center;
    justify-content:space-between;
    cursor:pointer;
    user-select:none;
  }
  .group-title h3{
    margin:0;
    font-size:13.5px;
    font-weight:700;
    color:var(--maroon-dark);
  }
  .group-title .chev{
    font-size:12px;
    color:var(--muted);
    transition:transform .15s;
  }
  .group.collapsed .chev{transform:rotate(-90deg);}
  .group-body{
    margin-top:12px;
    display:flex;
    flex-direction:column;
    gap:10px;
  }
  .group.collapsed .group-body{display:none;}

  .field label{
    display:block;
    font-size:11px;
    font-weight:600;
    color:var(--muted);
    margin-bottom:4px;
    text-transform:uppercase;
    letter-spacing:.3px;
  }
  .field input[type="text"],
  .field input[type="number"],
  .field select{
    width:100%;
    padding:7px 8px;
    border:1px solid #d5d8dd;
    border-radius:5px;
    font-size:13px;
    font-family:inherit;
  }
  .field input[type="color"]{
    width:44px;
    height:30px;
    padding:2px;
    border:1px solid #d5d8dd;
    border-radius:5px;
    cursor:pointer;
  }
  .row2{display:flex;gap:8px;}
  .row2 .field{flex:1;}
  .row4{display:flex;gap:8px;flex-wrap:wrap;}
  .row4 .field{flex:1;min-width:70px;}

  .filebtn{
    display:inline-block;
    width:100%;
    text-align:center;
    padding:8px;
    border:1px dashed #b9bec7;
    border-radius:6px;
    font-size:12.5px;
    color:var(--muted);
    cursor:pointer;
    background:#fafbfc;
  }
  .filebtn:hover{border-color:var(--accent);color:var(--accent);}
  .filebtn input{display:none;}

  .reset-link{
    font-size:11px;
    color:var(--accent);
    cursor:pointer;
    text-decoration:underline;
    background:none;
    border:none;
    padding:0;
  }

  /* =========== RIGHT PREVIEW =========== */
  .preview-wrap{
    flex:1;
    min-width:340px;
    display:flex;
    flex-direction:column;
    align-items:center;
    gap:16px;
  }
  .zoom-controls{
    display:flex;
    align-items:center;
    gap:10px;
    font-size:12px;
    color:var(--muted);
  }
  .zoom-controls input{vertical-align:middle;}

  .card-stage{
    background:repeating-conic-gradient(#e9eaed 0% 25%, #f6f7f8 0% 50%) 50% / 20px 20px;
    padding:40px;
    border-radius:12px;
  }

  .id-card{
    position:relative;
    background-image: url('{{ asset('storage/' . $selectedSample->file_path) }}');
    background-size:100% 100%;
    background-repeat:no-repeat;
    background-position:center;
    overflow:hidden;
    box-shadow:0 8px 24px rgba(0,0,0,.25);
    border-radius:6px;
    transform-origin:top center;
  }

  .el{
    position:absolute;
    cursor:move;
    outline:1px dashed transparent;
  }
  .el:hover{outline-color:rgba(47,111,237,.6);}
  .el.dragging{outline-color:var(--accent);z-index:50;}

  .el-photo{
    object-fit:cover;
    border:3px solid var(--maroon);
    background:#eee;
  }
  .el-text{
    white-space:nowrap;
    line-height:1.25;
  }
  .el-qr{
    object-fit:contain;
  }

  .hint{
    font-size:12px;
    color:var(--muted);
    text-align:center;
    max-width:700px;
  }

  ::-webkit-scrollbar{width:8px;}
  ::-webkit-scrollbar-thumb{background:#c9ccd1;border-radius:4px;}
</style>
</head>
<body>

<div class="topbar">
  <div>
    <h1>ID Card Editor</h1>
    <div class="sub">Mother's Pride School · drag fields on the card or use the controls</div>
  </div>
  <button id="exportLayoutBtn" style="margin-right:8px;background:#fff;color:var(--maroon-dark);border:1px solid #fff;">💾 Export Layout</button>
  <button id="importLayoutBtn" style="margin-right:8px;background:transparent;color:#fff;border:1px solid rgba(255,255,255,.6);">📂 Import Layout</button>
  <input type="file" id="importLayoutFile" accept="application/json" style="display:none;">
  <button id="downloadBtn">⬇ Download PNG</button>
</div>

<div class="editor">

  <!-- ===================== LEFT CONTROLS ===================== -->
  <div class="controls" id="controlsPanel">

    <!-- CARD BACKGROUND -->
    <div class="group">
      <div class="group-title"><h3>Card Background</h3><span class="chev">▾</span></div>
      <div class="group-body">
        <label class="filebtn">Upload card design (portrait or landscape)
          <input type="file" id="bgUpload" accept="image/*">
        </label>
        <div style="font-size:11px;color:var(--muted);">The card auto-sizes to match your image's orientation — vertical designs stay vertical, horizontal designs stay horizontal.</div>
      </div>
    </div>

    <!-- STUDENT PHOTO -->
    <div class="group">
      <div class="group-title"><h3>Student Photo</h3><span class="chev">▾</span></div>
      <div class="group-body">
        <label class="filebtn">Click to upload photo
          <input type="file" id="photoUpload" accept="image/*">
        </label>
        <div class="row4">
          <div class="field"><label>X</label><input type="number" id="photoX" value="55"></div>
          <div class="field"><label>Y</label><input type="number" id="photoY" value="325"></div>
          <div class="field"><label>W</label><input type="number" id="photoW" value="150"></div>
          <div class="field"><label>H</label><input type="number" id="photoH" value="150"></div>
        </div>
      </div>
    </div>

    <!-- STUDENT NAME -->
    <div class="group">
      <div class="group-title"><h3>Student Name</h3><span class="chev">▾</span></div>
      <div class="group-body">
        <div class="field"><label>Text</label><input type="text" id="nameText" value="AARAV SHARMA"></div>
        <div class="row4">
          <div class="field"><label>X</label><input type="number" id="nameX" value="230"></div>
          <div class="field"><label>Y</label><input type="number" id="nameY" value="340"></div>
          <div class="field"><label>Size</label><input type="number" id="nameSize" value="24"></div>
        </div>
        <div class="row2">
          <div class="field"><label>Color</label><input type="color" id="nameColor" value="#16009f"></div>
          <div class="field"><label>Weight</label>
            <select id="nameWeight">
              <option value="700" selected>Bold</option>
              <option value="400">Normal</option>
            </select>
          </div>
        </div>
      </div>
    </div>

    <!-- FATHER'S NAME -->
    <div class="group">
      <div class="group-title"><h3>Father's Name</h3><span class="chev">▾</span></div>
      <div class="group-body">
        <div class="field"><label>Text</label><input type="text" id="fatherText" value="Father: Rakesh Sharma"></div>
        <div class="row4">
          <div class="field"><label>X</label><input type="number" id="fatherX" value="230"></div>
          <div class="field"><label>Y</label><input type="number" id="fatherY" value="378"></div>
          <div class="field"><label>Size</label><input type="number" id="fatherSize" value="15"></div>
        </div>
        <div class="field"><label>Color</label><input type="color" id="fatherColor" value="#1f2430"></div>
      </div>
    </div>

    <!-- MOTHER'S NAME -->
    <div class="group">
      <div class="group-title"><h3>Mother's Name</h3><span class="chev">▾</span></div>
      <div class="group-body">
        <div class="field"><label>Text</label><input type="text" id="motherText" value="Mother: Anita Sharma"></div>
        <div class="row4">
          <div class="field"><label>X</label><input type="number" id="motherX" value="230"></div>
          <div class="field"><label>Y</label><input type="number" id="motherY" value="403"></div>
          <div class="field"><label>Size</label><input type="number" id="motherSize" value="15"></div>
        </div>
        <div class="field"><label>Color</label><input type="color" id="motherColor" value="#1f2430"></div>
      </div>
    </div>

    <!-- CLASS -->
    <div class="group">
      <div class="group-title"><h3>Class &amp; Section</h3><span class="chev">▾</span></div>
      <div class="group-body">
        <div class="field"><label>Text</label><input type="text" id="classText" value="Class: V - B"></div>
        <div class="row4">
          <div class="field"><label>X</label><input type="number" id="classX" value="230"></div>
          <div class="field"><label>Y</label><input type="number" id="classY" value="428"></div>
          <div class="field"><label>Size</label><input type="number" id="classSize" value="15"></div>
        </div>
        <div class="field"><label>Color</label><input type="color" id="classColor" value="#1f2430"></div>
      </div>
    </div>

    <!-- DOB -->
    <div class="group">
      <div class="group-title"><h3>Date of Birth</h3><span class="chev">▾</span></div>
      <div class="group-body">
        <div class="field"><label>Text</label><input type="text" id="dobText" value="DOB: 12-05-2015"></div>
        <div class="row4">
          <div class="field"><label>X</label><input type="number" id="dobX" value="230"></div>
          <div class="field"><label>Y</label><input type="number" id="dobY" value="453"></div>
          <div class="field"><label>Size</label><input type="number" id="dobSize" value="15"></div>
        </div>
        <div class="field"><label>Color</label><input type="color" id="dobColor" value="#1f2430"></div>
      </div>
    </div>

    <!-- ADMISSION / ROLL NO -->
    <div class="group">
      <div class="group-title"><h3>Admission / Roll No</h3><span class="chev">▾</span></div>
      <div class="group-body">
        <div class="field"><label>Text</label><input type="text" id="admText" value="Adm No: MP-2026-0143"></div>
        <div class="row4">
          <div class="field"><label>X</label><input type="number" id="admX" value="230"></div>
          <div class="field"><label>Y</label><input type="number" id="admY" value="478"></div>
          <div class="field"><label>Size</label><input type="number" id="admSize" value="15"></div>
        </div>
        <div class="field"><label>Color</label><input type="color" id="admColor" value="#1f2430"></div>
      </div>
    </div>

    <!-- BLOOD GROUP / CONTACT -->
    <div class="group">
      <div class="group-title"><h3>Blood Group / Contact</h3><span class="chev">▾</span></div>
      <div class="group-body">
        <div class="field"><label>Text</label><input type="text" id="bloodText" value="Blood Group: O+  |  Ph: 98765 43210"></div>
        <div class="row4">
          <div class="field"><label>X</label><input type="number" id="bloodX" value="55"></div>
          <div class="field"><label>Y</label><input type="number" id="bloodY" value="817"></div>
          <div class="field"><label>Size</label><input type="number" id="bloodSize" value="13"></div>
        </div>
        <div class="field"><label>Color</label><input type="color" id="bloodColor" value="#ffffff"></div>
      </div>
    </div>

    <!-- QR CODE -->
    <div class="group">
      <div class="group-title"><h3>QR Code</h3><span class="chev">▾</span></div>
      <div class="group-body">
        <div class="field"><label>Data (usually admission no.)</label><input type="text" id="qrData" value="MP-2026-0143"></div>
        <div class="row4">
          <div class="field"><label>X</label><input type="number" id="qrX" value="600"></div>
          <div class="field"><label>Y</label><input type="number" id="qrY" value="800"></div>
          <div class="field"><label>Size</label><input type="number" id="qrSize" value="80"></div>
        </div>
      </div>
    </div>

    <div class="group">
      <button class="reset-link" id="resetBtn">↺ Reset all fields to default position</button>
    </div>

  </div>

  <!-- ===================== RIGHT PREVIEW ===================== -->
  <div class="preview-wrap">

    <div class="zoom-controls">
      Zoom
      <input type="range" id="zoom" min="50" max="150" value="100">
      <span id="zoomVal">100%</span>
    </div>

    <div class="card-stage">
      <div id="idCard" class="id-card">

        <img id="elPhoto" class="el el-photo"
             src="https://placehold.co/300x300/eeeeee/999999?text=Photo" alt="Student Photo">

        <div id="elName" class="el el-text">AARAV SHARMA</div>
        <div id="elFather" class="el el-text">Father: Rakesh Sharma</div>
        <div id="elMother" class="el el-text">Mother: Anita Sharma</div>
        <div id="elClass" class="el el-text">Class: V - B</div>
        <div id="elDob" class="el el-text">DOB: 12-05-2015</div>
        <div id="elAdm" class="el el-text">Adm No: MP-2026-0143</div>
        <div id="elBlood" class="el el-text">Blood Group: O+  |  Ph: 98765 43210</div>

        <img id="elQr" class="el el-qr"
             src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=MP-2026-0143" alt="QR">

      </div>
    </div>

    <div class="hint">Tip: drag any field directly on the card to reposition it — the X/Y boxes on the left update automatically.</div>
  </div>

</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script>
(function(){
  const card = document.getElementById('idCard');
  const MAX_W = 750, MAX_H = 560; // display bounding box in the editor
  let CARD_W = 700, CARD_H = 450;

  function setCardSize(naturalW, naturalH){
    const scale = Math.min(MAX_W / naturalW, MAX_H / naturalH, 1.5);
    CARD_W = Math.round(naturalW * scale);
    CARD_H = Math.round(naturalH * scale);
    card.style.width = CARD_W + 'px';
    card.style.height = CARD_H + 'px';
  }
  // the bundled default background is 1400x900 (landscape)
  setCardSize(1400, 900);

  // ---- EXIF-aware image loading ----
  // Phone photos often store pixels in landscape order and rely on an EXIF
  // "orientation" tag to display upright/portrait. Reading naturalWidth/
  // naturalHeight directly ignores that tag, so a genuinely vertical photo
  // can get treated as landscape. We read the tag ourselves and bake the
  // correct rotation into a canvas, so sizing and display always match
  // what the photo actually looks like.
  function readExifOrientation(arrayBuffer){
    const view = new DataView(arrayBuffer);
    if(view.byteLength < 4 || view.getUint16(0,false) !== 0xFFD8) return 1;
    let offset = 2;
    while(offset < view.byteLength - 1){
      const marker = view.getUint16(offset, false);
      offset += 2;
      if(marker === 0xFFE1){
        if(view.getUint32(offset+2,false) !== 0x45786966) return 1; // "Exif"
        const tiffOffset = offset+8;
        const little = view.getUint16(tiffOffset,false) === 0x4949;
        const firstIFDOffset = view.getUint32(tiffOffset+4, little);
        const dirStart = tiffOffset + firstIFDOffset;
        const entries = view.getUint16(dirStart, little);
        for(let i=0;i<entries;i++){
          const entryOffset = dirStart + 2 + i*12;
          if(view.getUint16(entryOffset, little) === 0x0112){
            return view.getUint16(entryOffset+8, little);
          }
        }
        return 1;
      } else if((marker & 0xFF00) !== 0xFF00){
        break;
      } else {
        offset += view.getUint16(offset, false);
      }
    }
    return 1;
  }

  function normalizeImage(file, callback){
    const reader = new FileReader();
    reader.onload = function(e){
      const arrayBuffer = e.target.result;
      let orientation = 1;
      try{ orientation = readExifOrientation(arrayBuffer); }catch(err){ orientation = 1; }
      const url = URL.createObjectURL(new Blob([arrayBuffer]));
      const img = new Image();
      img.onload = function(){
        const w = img.naturalWidth, h = img.naturalHeight;
        const canvas = document.createElement('canvas');
        const rotated = orientation >= 5 && orientation <= 8;
        canvas.width = rotated ? h : w;
        canvas.height = rotated ? w : h;
        const ctx = canvas.getContext('2d');
        switch(orientation){
          case 2: ctx.transform(-1,0,0,1,w,0); break;
          case 3: ctx.transform(-1,0,0,-1,w,h); break;
          case 4: ctx.transform(1,0,0,-1,0,h); break;
          case 5: ctx.transform(0,1,1,0,0,0); break;
          case 6: ctx.transform(0,1,-1,0,h,0); break;
          case 7: ctx.transform(0,-1,-1,0,h,w); break;
          case 8: ctx.transform(0,-1,1,0,0,w); break;
          default: break;
        }
        ctx.drawImage(img, 0, 0);
        URL.revokeObjectURL(url);
        callback(canvas.toDataURL('image/jpeg', 0.92), canvas.width, canvas.height);
      };
      img.src = url;
    };
    reader.readAsArrayBuffer(file);
  }

  document.getElementById('bgUpload').addEventListener('change', function(e){
    const file = e.target.files[0];
    if(!file) return;
    normalizeImage(file, (dataUrl, w, h) => {
      setCardSize(w, h);
      card.style.backgroundImage = 'url(' + dataUrl + ')';
    });
  });

  // ---- field config: maps control ids to element + style props ----
  const fields = [
    { key:'photo',  el:'elPhoto', x:'photoX', y:'photoY', w:'photoW', h:'photoH' },
    { key:'name',   el:'elName',   x:'nameX',   y:'nameY',   text:'nameText',   size:'nameSize',   color:'nameColor',   weight:'nameWeight' },
    { key:'father', el:'elFather', x:'fatherX', y:'fatherY', text:'fatherText', size:'fatherSize', color:'fatherColor' },
    { key:'mother', el:'elMother', x:'motherX', y:'motherY', text:'motherText', size:'motherSize', color:'motherColor' },
    { key:'class',  el:'elClass',  x:'classX',  y:'classY',  text:'classText',  size:'classSize',  color:'classColor' },
    { key:'dob',    el:'elDob',    x:'dobX',    y:'dobY',    text:'dobText',    size:'dobSize',    color:'dobColor' },
    { key:'adm',    el:'elAdm',    x:'admX',    y:'admY',    text:'admText',    size:'admSize',    color:'admColor' },
    { key:'blood',  el:'elBlood',  x:'bloodX',  y:'bloodY',  text:'bloodText',  size:'bloodSize',  color:'bloodColor' },
    { key:'qr',     el:'elQr',     x:'qrX',     y:'qrY',     w:'qrSize',        h:'qrSize' },
  ];

  function applyField(f){
    const el = document.getElementById(f.el);
    if(!el) return;
    if(f.x) el.style.left = (document.getElementById(f.x).value||0) + 'px';
    if(f.y) el.style.top  = (document.getElementById(f.y).value||0) + 'px';
    if(f.w) el.style.width  = (document.getElementById(f.w).value||0) + 'px';
    if(f.h) el.style.height = (document.getElementById(f.h).value||0) + 'px';
    if(f.text) el.textContent = document.getElementById(f.text).value;
    if(f.size) el.style.fontSize = (document.getElementById(f.size).value||12) + 'px';
    if(f.color) el.style.color = document.getElementById(f.color).value;
    if(f.weight) el.style.fontWeight = document.getElementById(f.weight).value;
  }

  function wireField(f){
    ['x','y','w','h','text','size','color','weight'].forEach(k=>{
      if(f[k]){
        document.getElementById(f[k]).addEventListener('input', ()=>applyField(f));
      }
    });
    applyField(f);
  }

  fields.forEach(wireField);

  // font weight default bold for name
  document.getElementById('elName').style.fontWeight = '700';
  document.getElementById('elName').style.textTransform = 'uppercase';

  // ---- QR data -> rebuild qr image ----
  const qrDataInput = document.getElementById('qrData');
  function updateQr(){
    const val = encodeURIComponent(qrDataInput.value || '');
    document.getElementById('elQr').src = 'https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=' + val;
  }
  qrDataInput.addEventListener('input', updateQr);

  // keep admission-no text and qr data in sync by default (user can still edit independently)
  document.getElementById('admText').addEventListener('input', function(){
    // no forced sync, kept independent intentionally
  });

  // ---- photo upload ----
  document.getElementById('photoUpload').addEventListener('change', function(e){
    const file = e.target.files[0];
    if(!file) return;
    normalizeImage(file, (dataUrl) => {
      document.getElementById('elPhoto').src = dataUrl;
    });
  });

  // ---- draggable elements ----
  let dragEl = null, offX = 0, offY = 0;

  function xyControlsFor(elId){
    return fields.find(f => f.el === elId);
  }

  document.querySelectorAll('.el').forEach(el=>{
    el.addEventListener('mousedown', function(e){
      dragEl = el;
      el.classList.add('dragging');
      const rect = card.getBoundingClientRect();
      const scale = rect.width / CARD_W;
      offX = (e.clientX - rect.left)/scale - parseFloat(el.style.left||0);
      offY = (e.clientY - rect.top)/scale - parseFloat(el.style.top||0);
      e.preventDefault();
    });
  });

  document.addEventListener('mousemove', function(e){
    if(!dragEl) return;
    const rect = card.getBoundingClientRect();
    const scale = rect.width / CARD_W;
    let nx = Math.round((e.clientX - rect.left)/scale - offX);
    let ny = Math.round((e.clientY - rect.top)/scale - offY);
    nx = Math.max(0, Math.min(CARD_W, nx));
    ny = Math.max(0, Math.min(CARD_H, ny));
    dragEl.style.left = nx + 'px';
    dragEl.style.top = ny + 'px';
    const f = xyControlsFor(dragEl.id);
    if(f){
      if(f.x) document.getElementById(f.x).value = nx;
      if(f.y) document.getElementById(f.y).value = ny;
    }
  });

  document.addEventListener('mouseup', function(){
    if(dragEl) dragEl.classList.remove('dragging');
    dragEl = null;
  });

  // ---- collapsible groups ----
  document.querySelectorAll('.group-title').forEach(t=>{
    t.addEventListener('click', ()=> t.parentElement.classList.toggle('collapsed'));
  });

  // ---- zoom ----
  const zoom = document.getElementById('zoom');
  const zoomVal = document.getElementById('zoomVal');
  zoom.addEventListener('input', ()=>{
    const s = zoom.value/100;
    card.style.transform = 'scale(' + s + ')';
    zoomVal.textContent = zoom.value + '%';
  });

  // ---- reset ----
  const defaults = {};
  document.querySelectorAll('.controls input, .controls select').forEach(inp=>{
    defaults[inp.id] = inp.value;
  });
  document.getElementById('resetBtn').addEventListener('click', ()=>{
    Object.keys(defaults).forEach(id=>{
      document.getElementById(id).value = defaults[id];
    });
    fields.forEach(applyField);
    updateQr();
  });

  // ---- export / import layout ----
  // The layout JSON captures every field's position/style plus the card
  // background, so it's a complete, portable "design" that a bulk-print
  // tool (or your backend) can apply to any number of student records.
  function buildLayoutJSON(){
    const bg = getComputedStyle(card).backgroundImage; // url("data:image/jpeg;base64,...")
    const layout = {
      cardWidth: CARD_W,
      cardHeight: CARD_H,
      background: bg.slice(5, -2), // strip url(" ... ")
      fields: {}
    };
    fields.forEach(f=>{
      const el = document.getElementById(f.el);
      layout.fields[f.key] = {
        x: parseFloat(el.style.left)||0,
        y: parseFloat(el.style.top)||0,
        width: f.w ? (parseFloat(el.style.width)||0) : undefined,
        height: f.h ? (parseFloat(el.style.height)||0) : undefined,
        fontSize: f.size ? (parseFloat(el.style.fontSize)||undefined) : undefined,
        color: f.color ? el.style.color : undefined,
        fontWeight: f.weight ? el.style.fontWeight : undefined,
      };
    });
    return layout;
  }

  document.getElementById('exportLayoutBtn').addEventListener('click', ()=>{
    const layout = buildLayoutJSON();
    const blob = new Blob([JSON.stringify(layout, null, 2)], {type:'application/json'});
    const a = document.createElement('a');
    a.href = URL.createObjectURL(blob);
    a.download = 'idcard-layout.json';
    a.click();
  });

  document.getElementById('importLayoutBtn').addEventListener('click', ()=>{
    document.getElementById('importLayoutFile').click();
  });

  document.getElementById('importLayoutFile').addEventListener('change', function(e){
    const file = e.target.files[0];
    if(!file) return;
    const reader = new FileReader();
    reader.onload = evt => {
      try{
        const layout = JSON.parse(evt.target.result);
        if(layout.background){
          card.style.backgroundImage = 'url(' + layout.background + ')';
        }
        fields.forEach(f=>{
          const data = layout.fields && layout.fields[f.key];
          if(!data) return;
          if(f.x) document.getElementById(f.x).value = data.x ?? 0;
          if(f.y) document.getElementById(f.y).value = data.y ?? 0;
          if(f.w && data.width!=null) document.getElementById(f.w).value = data.width;
          if(f.h && data.height!=null) document.getElementById(f.h).value = data.height;
          if(f.size && data.fontSize!=null) document.getElementById(f.size).value = data.fontSize;
          if(f.color && data.color) document.getElementById(f.color).value = rgbToHex(data.color);
          applyField(f);
        });
        alert('Layout loaded.');
      }catch(err){
        alert('Could not read that layout file.');
        console.error(err);
      }
    };
    reader.readAsText(file);
  });

  function rgbToHex(rgb){
    if(rgb.startsWith('#')) return rgb;
    const m = rgb.match(/\d+/g);
    if(!m) return '#000000';
    return '#' + m.slice(0,3).map(n=>(+n).toString(16).padStart(2,'0')).join('');
  }

  // ---- download as PNG ----
  document.getElementById('downloadBtn').addEventListener('click', ()=>{
    const prevTransform = card.style.transform;
    card.style.transform = 'none';
    html2canvas(card, { scale: 3, useCORS: true, backgroundColor: null }).then(canvas=>{
      card.style.transform = prevTransform;
      const link = document.createElement('a');
      link.download = 'id-card.png';
      link.href = canvas.toDataURL('image/png');
      link.click();
    }).catch(err=>{
      card.style.transform = prevTransform;
      alert('Could not export image (this can happen if the browser blocks the QR image due to CORS). Try again or take a screenshot instead.');
      console.error(err);
    });
  });

})();
</script>

</body>
</html>

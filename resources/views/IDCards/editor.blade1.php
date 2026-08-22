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

*{
    box-sizing:border-box;
}

body{
    margin:0;
    font-family:'Segoe UI',Arial,sans-serif;
    background:var(--bg);
    color:var(--ink);
}

/* ================= TOP BAR ================= */

.topbar{
    background:var(--maroon);
    color:#fff;
    padding:14px 24px;
    display:flex;
    align-items:center;
    justify-content:space-between;
    box-shadow:0 2px 8px rgba(0,0,0,.15);
    gap:10px;
}

.topbar-left{
    flex:1;
}

.topbar h1{
    font-size:17px;
    margin:0;
    font-weight:700;
}

.topbar .sub{
    font-size:12px;
    opacity:.85;
    margin-top:2px;
}

.topbar-buttons{
    display:flex;
    gap:8px;
}

.topbar button{
    border:none;
    padding:9px 16px;
    border-radius:6px;
    font-weight:700;
    font-size:13px;
    cursor:pointer;
}

#exportLayoutBtn{
    background:#fff;
    color:var(--maroon-dark);
}

#importLayoutBtn{
    background:transparent;
    color:#fff;
    border:1px solid rgba(255,255,255,.6);
}

#downloadBtn{
    background:var(--gold);
    color:#3a2a00;
}

/* ================= EDITOR ================= */

.editor{
    display:flex;
    gap:24px;
    padding:24px;
    align-items:flex-start;
}

/* ================= CONTROLS ================= */

.controls{
    width:340px;
    max-height:calc(100vh - 100px);
    overflow-y:auto;
    background:#fff;
    border-radius:10px;
    box-shadow:0 2px 10px rgba(0,0,0,.08);
    padding:6px 0 16px;
    flex-shrink:0;
}

.group{
    border-bottom:1px solid var(--line);
    padding:14px 18px;
}

.group:last-child{
    border-bottom:none;
}

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
}

.group.collapsed .chev{
    transform:rotate(-90deg);
}

.group-body{
    margin-top:12px;
    display:flex;
    flex-direction:column;
    gap:10px;
}

.group.collapsed .group-body{
    display:none;
}

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

.row2{
    display:flex;
    gap:8px;
}

.row2 .field{
    flex:1;
}

.row4{
    display:flex;
    gap:8px;
    flex-wrap:wrap;
}

.row4 .field{
    flex:1;
    min-width:70px;
}

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

.filebtn:hover{
    border-color:var(--accent);
    color:var(--accent);
}

.filebtn input{
    display:none;
}

.reset-link{
    font-size:11px;
    color:var(--accent);
    cursor:pointer;
    text-decoration:underline;
    background:none;
    border:none;
    padding:0;
}

/* ================= SWITCH ================= */

.switch{
    position:relative;
    display:inline-block;
    width:34px;
    height:19px;
}

.switch input{
    opacity:0;
    width:0;
    height:0;
}

.switch .slider{
    position:absolute;
    cursor:pointer;
    inset:0;
    background:#ccced3;
    border-radius:19px;
}

.switch .slider:before{
    position:absolute;
    content:"";
    height:14px;
    width:14px;
    left:2.5px;
    bottom:2.5px;
    background:#fff;
    border-radius:50%;
    transition:.15s;
}

.switch input:checked + .slider{
    background:var(--maroon);
}

.switch input:checked + .slider:before{
    transform:translateX(15px);
}

.group-title-right{
    display:flex;
    align-items:center;
    gap:10px;
}

/* ================= TOGGLE ALL ================= */

.toggle-all-row{
    display:flex;
    align-items:center;
    justify-content:space-between;
    padding:12px 18px;
    border-bottom:1px solid var(--line);
    background:#fafbfc;
}

.toggle-all-row span{
    font-size:12.5px;
    font-weight:700;
    color:var(--maroon-dark);
}

.toggle-all-row .links{
    display:flex;
    gap:10px;
}

.toggle-all-row button{
    font-size:11px;
    color:var(--accent);
    background:none;
    border:none;
    cursor:pointer;
    text-decoration:underline;
}

/* ================= PREVIEW ================= */

.preview-wrap{
    flex:1;
    min-width:400px;
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

.card-stage{
    width:100%;
    min-height:650px;

    background:
        repeating-conic-gradient(
            #e9eaed 0% 25%,
            #f6f7f8 0% 50%
        ) 50% / 20px 20px;

    padding:40px;

    border-radius:12px;

    display:flex;
    align-items:flex-start;
    justify-content:center;

    overflow:auto;
}

/*
IMPORTANT

The card always keeps its REAL dimensions.

Example:
1400 x 900

The preview is scaled using transform.

Therefore:

Admission Y = 478
Signature Y = 790
QR Y = 800

all remain inside the real card.
*/

.card-preview{
    transform-origin:top center;
}

.id-card{
    position:relative;

    width:1400px;
    height:900px;

    background-image:url('{{ asset('storage/' . $selectedSample->file_path) }}');
    background-size:100% 100%;
    background-repeat:no-repeat;
    background-position:center;

    overflow:hidden;

    box-shadow:0 8px 24px rgba(0,0,0,.25);

    border-radius:6px;
}

.el{
    position:absolute;
    cursor:move;
    outline:1px dashed transparent;
}

.el:hover{
    outline-color:rgba(47,111,237,.6);
}

.el.dragging{
    outline-color:var(--accent);
    z-index:1000;
}

.el-photo{
    object-fit:cover;
    border:3px solid var(--maroon);
    background:#eee;
}

.el-text{
    white-space:nowrap;
    line-height:1.25;
}

.el-logo,
.el-sign{
    object-fit:contain;
    background:transparent;
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

/* ================= SCROLLBAR ================= */

::-webkit-scrollbar{
    width:8px;
}

::-webkit-scrollbar-thumb{
    background:#c9ccd1;
    border-radius:4px;
}

</style>
</head>

<body>

<!-- ===================================================== -->
<!-- TOP BAR -->
<!-- ===================================================== -->

<div class="topbar">

    <div class="topbar-left">
        <h1>ID Card Editor</h1>
        <div class="sub">
            Mother's Pride School · drag fields on the card or use the controls
        </div>
    </div>

    <div class="topbar-buttons">

        <button id="exportLayoutBtn">
            💾 Export Layout
        </button>

        <button id="importLayoutBtn">
            📂 Import Layout
        </button>

        <input
            type="file"
            id="importLayoutFile"
            accept="application/json"
            style="display:none"
        >

        <button id="downloadBtn">
            ⬇ Download PNG
        </button>

    </div>

</div>


<div class="editor">

<!-- ===================================================== -->
<!-- LEFT CONTROLS -->
<!-- ===================================================== -->

<div class="controls">

<div class="toggle-all-row">

    <span>Field visibility</span>

    <div class="links">
        <button id="showAllBtn">Show all</button>
        <button id="hideAllBtn">Hide all</button>
    </div>

</div>


<!-- CARD BACKGROUND -->

<div class="group">

    <div class="group-title">
        <h3>Card Background</h3>
        <span class="chev">▾</span>
    </div>

    <div class="group-body">

        <label class="filebtn">
            Upload card design
            <input type="file" id="bgUpload" accept="image/*">
        </label>

        <div style="font-size:11px;color:var(--muted);">
            Portrait and landscape images are supported.
        </div>

    </div>

</div>


<!-- LOGO -->

<div class="group">

    <div class="group-title">

        <h3>School Logo</h3>

        <div class="group-title-right">

            <label class="switch">
                <input type="checkbox" id="logoToggle" checked>
                <span class="slider"></span>
            </label>

            <span class="chev">▾</span>

        </div>

    </div>

    <div class="group-body">

        <label class="filebtn">
            Click to upload logo
            <input type="file" id="logoUpload" accept="image/*">
        </label>

        <div class="row4">

            <div class="field">
                <label>X</label>
                <input type="number" id="logoX" value="30">
            </div>

            <div class="field">
                <label>Y</label>
                <input type="number" id="logoY" value="20">
            </div>

            <div class="field">
                <label>W</label>
                <input type="number" id="logoW" value="80">
            </div>

            <div class="field">
                <label>H</label>
                <input type="number" id="logoH" value="80">
            </div>

        </div>

    </div>

</div>


<!-- SCHOOL NAME -->

<div class="group">

<div class="group-title">

<h3>School Name</h3>

<div class="group-title-right">

<label class="switch">
<input type="checkbox" id="schoolNameToggle" checked>
<span class="slider"></span>
</label>

<span class="chev">▾</span>

</div>

</div>

<div class="group-body">

<div class="field">
<label>Text</label>
<input type="text" id="schoolNameText" value="Mother's Pride School">
</div>

<div class="row4">

<div class="field">
<label>X</label>
<input type="number" id="schoolNameX" value="130">
</div>

<div class="field">
<label>Y</label>
<input type="number" id="schoolNameY" value="25">
</div>

<div class="field">
<label>Size</label>
<input type="number" id="schoolNameSize" value="28">
</div>

</div>

<div class="row2">

<div class="field">
<label>Color</label>
<input type="color" id="schoolNameColor" value="#9e1b32">
</div>

<div class="field">

<label>Weight</label>

<select id="schoolNameWeight">

<option value="700">Bold</option>
<option value="400">Normal</option>

</select>

</div>

</div>

</div>

</div>


<!-- ADDRESS -->

<div class="group">

<div class="group-title">

<h3>Address</h3>

<div class="group-title-right">

<label class="switch">
<input type="checkbox" id="addressToggle" checked>
<span class="slider"></span>
</label>

<span class="chev">▾</span>

</div>

</div>

<div class="group-body">

<div class="field">
<label>Text</label>
<input type="text"
       id="addressText"
       value="123 Education Lane, Varanasi, UP - 221001">
</div>

<div class="row4">

<div class="field">
<label>X</label>
<input type="number" id="addressX" value="130">
</div>

<div class="field">
<label>Y</label>
<input type="number" id="addressY" value="62">
</div>

<div class="field">
<label>Size</label>
<input type="number" id="addressSize" value="13">
</div>

</div>

<div class="field">

<label>Color</label>

<input
type="color"
id="addressColor"
value="#1f2430">

</div>

</div>

</div>


<!-- SESSION -->

<div class="group">

<div class="group-title">

<h3>Session</h3>

<div class="group-title-right">

<label class="switch">
<input type="checkbox" id="sessionToggle" checked>
<span class="slider"></span>
</label>

<span class="chev">▾</span>

</div>

</div>

<div class="group-body">

<div class="field">
<label>Text</label>
<input type="text"
       id="sessionText"
       value="Session: 2026-2027">
</div>

<div class="row4">

<div class="field">
<label>X</label>
<input type="number" id="sessionX" value="130">
</div>

<div class="field">
<label>Y</label>
<input type="number" id="sessionY" value="86">
</div>

<div class="field">
<label>Size</label>
<input type="number" id="sessionSize" value="13">
</div>

</div>

<div class="field">

<label>Color</label>

<input
type="color"
id="sessionColor"
value="#1f2430">

</div>

</div>

</div>


<!-- PHOTO -->

<div class="group">

<div class="group-title">

<h3>Student Photo</h3>

<div class="group-title-right">

<label class="switch">
<input type="checkbox" id="photoToggle" checked>
<span class="slider"></span>
</label>

<span class="chev">▾</span>

</div>

</div>

<div class="group-body">

<label class="filebtn">
Click to upload photo
<input type="file" id="photoUpload" accept="image/*">
</label>

<div class="row4">

<div class="field">
<label>X</label>
<input type="number" id="photoX" value="55">
</div>

<div class="field">
<label>Y</label>
<input type="number" id="photoY" value="325">
</div>

<div class="field">
<label>W</label>
<input type="number" id="photoW" value="150">
</div>

<div class="field">
<label>H</label>
<input type="number" id="photoH" value="150">
</div>

</div>

</div>

</div>


<!-- STUDENT NAME -->

<div class="group">

<div class="group-title">

<h3>Student Name</h3>

<div class="group-title-right">

<label class="switch">
<input type="checkbox" id="nameToggle" checked>
<span class="slider"></span>
</label>

<span class="chev">▾</span>

</div>

</div>

<div class="group-body">

<div class="field">
<label>Text</label>
<input type="text" id="nameText" value="AARAV SHARMA">
</div>

<div class="row4">

<div class="field">
<label>X</label>
<input type="number" id="nameX" value="230">
</div>

<div class="field">
<label>Y</label>
<input type="number" id="nameY" value="340">
</div>

<div class="field">
<label>Size</label>
<input type="number" id="nameSize" value="24">
</div>

</div>

<div class="row2">

<div class="field">
<label>Color</label>
<input type="color" id="nameColor" value="#16009f">
</div>

<div class="field">

<label>Weight</label>

<select id="nameWeight">

<option value="700">Bold</option>
<option value="400">Normal</option>

</select>

</div>

</div>

</div>

</div>


<!-- FATHER -->

<div class="group">

<div class="group-title">

<h3>Father's Name</h3>

<div class="group-title-right">

<label class="switch">
<input type="checkbox" id="fatherToggle" checked>
<span class="slider"></span>
</label>

<span class="chev">▾</span>

</div>

</div>

<div class="group-body">

<div class="field">
<label>Text</label>
<input type="text"
       id="fatherText"
       value="Father: Rakesh Sharma">
</div>

<div class="row4">

<div class="field">
<label>X</label>
<input type="number" id="fatherX" value="230">
</div>

<div class="field">
<label>Y</label>
<input type="number" id="fatherY" value="378">
</div>

<div class="field">
<label>Size</label>
<input type="number" id="fatherSize" value="15">
</div>

</div>

<div class="field">
<label>Color</label>
<input type="color" id="fatherColor" value="#1f2430">
</div>

</div>

</div>


<!-- MOTHER -->

<div class="group">

<div class="group-title">

<h3>Mother's Name</h3>

<div class="group-title-right">

<label class="switch">
<input type="checkbox" id="motherToggle" checked>
<span class="slider"></span>
</label>

<span class="chev">▾</span>

</div>

</div>

<div class="group-body">

<div class="field">
<label>Text</label>
<input type="text"
       id="motherText"
       value="Mother: Anita Sharma">
</div>

<div class="row4">

<div class="field">
<label>X</label>
<input type="number" id="motherX" value="230">
</div>

<div class="field">
<label>Y</label>
<input type="number" id="motherY" value="403">
</div>

<div class="field">
<label>Size</label>
<input type="number" id="motherSize" value="15">
</div>

</div>

<div class="field">
<label>Color</label>
<input type="color" id="motherColor" value="#1f2430">
</div>

</div>

</div>


<!-- CLASS -->

<div class="group">

<div class="group-title">

<h3>Class & Section</h3>

<div class="group-title-right">

<label class="switch">
<input type="checkbox" id="classToggle" checked>
<span class="slider"></span>
</label>

<span class="chev">▾</span>

</div>

</div>

<div class="group-body">

<div class="field">
<label>Text</label>
<input type="text"
       id="classText"
       value="Class: V - B">
</div>

<div class="row4">

<div class="field">
<label>X</label>
<input type="number" id="classX" value="230">
</div>

<div class="field">
<label>Y</label>
<input type="number" id="classY" value="428">
</div>

<div class="field">
<label>Size</label>
<input type="number" id="classSize" value="15">
</div>

</div>

<div class="field">
<label>Color</label>
<input type="color" id="classColor" value="#1f2430">
</div>

</div>

</div>


<!-- DOB -->

<div class="group">

<div class="group-title">

<h3>Date of Birth</h3>

<div class="group-title-right">

<label class="switch">
<input type="checkbox" id="dobToggle" checked>
<span class="slider"></span>
</label>

<span class="chev">▾</span>

</div>

</div>

<div class="group-body">

<div class="field">
<label>Text</label>
<input type="text"
       id="dobText"
       value="DOB: 12-05-2015">
</div>

<div class="row4">

<div class="field">
<label>X</label>
<input type="number" id="dobX" value="230">
</div>

<div class="field">
<label>Y</label>
<input type="number" id="dobY" value="453">
</div>

<div class="field">
<label>Size</label>
<input type="number" id="dobSize" value="15">
</div>

</div>

<div class="field">
<label>Color</label>
<input type="color" id="dobColor" value="#1f2430">
</div>

</div>

</div>


<!-- ADMISSION -->

<div class="group">

<div class="group-title">

<h3>Admission / Roll No</h3>

<div class="group-title-right">

<label class="switch">
<input type="checkbox" id="admToggle" checked>
<span class="slider"></span>
</label>

<span class="chev">▾</span>

</div>

</div>

<div class="group-body">

<div class="field">

<label>Text</label>

<input
type="text"
id="admText"
value="Adm No: MP-2026-0143">

</div>

<div class="row4">

<div class="field">
<label>X</label>
<input type="number" id="admX" value="230">
</div>

<div class="field">
<label>Y</label>
<input type="number" id="admY" value="478">
</div>

<div class="field">
<label>Size</label>
<input type="number" id="admSize" value="15">
</div>

</div>

<div class="field">

<label>Color</label>

<input
type="color"
id="admColor"
value="#1f2430">

</div>

</div>

</div>


<!-- BLOOD / PHONE -->

<div class="group">

<div class="group-title">

<h3>Blood Group / Phone</h3>

<div class="group-title-right">

<label class="switch">
<input type="checkbox" id="bloodToggle" checked>
<span class="slider"></span>
</label>

<span class="chev">▾</span>

</div>

</div>

<div class="group-body">

<div class="field">

<label>Text</label>

<input
type="text"
id="bloodText"
value="Blood Group: O+ | Ph: 98765 43210">

</div>

<div class="row4">

<div class="field">
<label>X</label>
<input type="number" id="bloodX" value="55">
</div>

<div class="field">
<label>Y</label>
<input type="number" id="bloodY" value="817">
</div>

<div class="field">
<label>Size</label>
<input type="number" id="bloodSize" value="13">
</div>

</div>

<div class="field">

<label>Color</label>

<input
type="color"
id="bloodColor"
value="#ffffff">

</div>

</div>

</div>


<!-- SIGNATURE -->

<div class="group">

<div class="group-title">

<h3>Principal Signature</h3>

<div class="group-title-right">

<label class="switch">
<input type="checkbox" id="signToggle" checked>
<span class="slider"></span>
</label>

<span class="chev">▾</span>

</div>

</div>

<div class="group-body">

<label class="filebtn">

Click to upload signature

<input
type="file"
id="signUpload"
accept="image/*">

</label>

<div class="row4">

<div class="field">
<label>X</label>
<input type="number" id="signX" value="1150">
</div>

<div class="field">
<label>Y</label>
<input type="number" id="signY" value="790">
</div>

<div class="field">
<label>W</label>
<input type="number" id="signW" value="180">
</div>

<div class="field">
<label>H</label>
<input type="number" id="signH" value="60">
</div>

</div>

</div>

</div>


<!-- QR -->

<div class="group">

<div class="group-title">

<h3>QR Code</h3>

<div class="group-title-right">

<label class="switch">
<input type="checkbox" id="qrToggle" checked>
<span class="slider"></span>
</label>

<span class="chev">▾</span>

</div>

</div>

<div class="group-body">

<div class="field">

<label>Data</label>

<input
type="text"
id="qrData"
value="MP-2026-0143">

</div>

<div class="row4">

<div class="field">
<label>X</label>
<input type="number" id="qrX" value="600">
</div>

<div class="field">
<label>Y</label>
<input type="number" id="qrY" value="800">
</div>

<div class="field">
<label>Size</label>
<input type="number" id="qrSize" value="80">
</div>

</div>

</div>

</div>


<div class="group">

<button
class="reset-link"
id="resetBtn">

↺ Reset all fields to default position

</button>

</div>

</div>


<!-- ===================================================== -->
<!-- PREVIEW -->
<!-- ===================================================== -->

<div class="preview-wrap">

<div class="zoom-controls">

Zoom

<input
type="range"
id="zoom"
min="25"
max="100"
value="50">

<span id="zoomVal">50%</span>

</div>


<div class="card-stage">

<div id="cardPreview" class="card-preview">

<div id="idCard" class="id-card">


<!-- LOGO -->

<img
id="elLogo"
class="el el-logo"
src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='160' height='160'%3E%3Crect width='160' height='160' fill='white'/%3E%3Ctext x='80' y='90' text-anchor='middle' font-size='22' fill='%239e1b32'%3ELOGO%3C/text%3E%3C/svg%3E"
alt="School Logo">


<!-- SCHOOL -->

<div id="elSchoolName" class="el el-text">
Mother's Pride School
</div>

<div id="elAddress" class="el el-text">
123 Education Lane, Varanasi, UP - 221001
</div>

<div id="elSession" class="el el-text">
Session: 2026-2027
</div>


<!-- PHOTO -->

<img
id="elPhoto"
class="el el-photo"
src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='300' height='300'%3E%3Crect width='300' height='300' fill='%23eeeeee'/%3E%3Ctext x='150' y='160' text-anchor='middle' font-size='30' fill='%23999999'%3EPhoto%3C/text%3E%3C/svg%3E"
alt="Student Photo">


<!-- STUDENT DETAILS -->

<div id="elName" class="el el-text">
AARAV SHARMA
</div>

<div id="elFather" class="el el-text">
Father: Rakesh Sharma
</div>

<div id="elMother" class="el el-text">
Mother: Anita Sharma
</div>

<div id="elClass" class="el el-text">
Class: V - B
</div>

<div id="elDob" class="el el-text">
DOB: 12-05-2015
</div>

<div id="elAdm" class="el el-text">
Adm No: MP-2026-0143
</div>

<div id="elBlood" class="el el-text">
Blood Group: O+ | Ph: 98765 43210
</div>


<!-- SIGNATURE -->

<img
id="elSign"
class="el el-sign"
src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='360' height='120'%3E%3Ctext x='180' y='70' text-anchor='middle' font-size='28' fill='%231f2430'%3ESignature%3C/text%3E%3C/svg%3E"
alt="Principal Signature">


<!-- QR CANVAS WILL BE INSERTED HERE -->

<div
id="elQr"
class="el el-qr">
</div>


</div>

</div>

</div>


<div class="hint">

Tip: drag any field directly on the card to reposition it.
The X/Y boxes update automatically.

</div>

</div>

</div>


<!-- ===================================================== -->
<!-- LIBRARIES -->
<!-- ===================================================== -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>


<script>

(function(){

"use strict";


/* ===================================================== */
/* CARD */
/* ===================================================== */

const card = document.getElementById("idCard");

const cardPreview = document.getElementById("cardPreview");

let CARD_W = 1400;
let CARD_H = 900;


/* ===================================================== */
/* FIELD CONFIGURATION */
/* ===================================================== */

const fields = [

{
key:"logo",
el:"elLogo",
x:"logoX",
y:"logoY",
w:"logoW",
h:"logoH",
toggle:"logoToggle"
},

{
key:"schoolName",
el:"elSchoolName",
x:"schoolNameX",
y:"schoolNameY",
text:"schoolNameText",
size:"schoolNameSize",
color:"schoolNameColor",
weight:"schoolNameWeight",
toggle:"schoolNameToggle"
},

{
key:"address",
el:"elAddress",
x:"addressX",
y:"addressY",
text:"addressText",
size:"addressSize",
color:"addressColor",
toggle:"addressToggle"
},

{
key:"session",
el:"elSession",
x:"sessionX",
y:"sessionY",
text:"sessionText",
size:"sessionSize",
color:"sessionColor",
toggle:"sessionToggle"
},

{
key:"photo",
el:"elPhoto",
x:"photoX",
y:"photoY",
w:"photoW",
h:"photoH",
toggle:"photoToggle"
},

{
key:"name",
el:"elName",
x:"nameX",
y:"nameY",
text:"nameText",
size:"nameSize",
color:"nameColor",
weight:"nameWeight",
toggle:"nameToggle"
},

{
key:"father",
el:"elFather",
x:"fatherX",
y:"fatherY",
text:"fatherText",
size:"fatherSize",
color:"fatherColor",
toggle:"fatherToggle"
},

{
key:"mother",
el:"elMother",
x:"motherX",
y:"motherY",
text:"motherText",
size:"motherSize",
color:"motherColor",
toggle:"motherToggle"
},

{
key:"class",
el:"elClass",
x:"classX",
y:"classY",
text:"classText",
size:"classSize",
color:"classColor",
toggle:"classToggle"
},

{
key:"dob",
el:"elDob",
x:"dobX",
y:"dobY",
text:"dobText",
size:"dobSize",
color:"dobColor",
toggle:"dobToggle"
},

{
key:"adm",
el:"elAdm",
x:"admX",
y:"admY",
text:"admText",
size:"admSize",
color:"admColor",
toggle:"admToggle"
},

{
key:"blood",
el:"elBlood",
x:"bloodX",
y:"bloodY",
text:"bloodText",
size:"bloodSize",
color:"bloodColor",
toggle:"bloodToggle"
},

{
key:"sign",
el:"elSign",
x:"signX",
y:"signY",
w:"signW",
h:"signH",
toggle:"signToggle"
},

{
key:"qr",
el:"elQr",
x:"qrX",
y:"qrY",
w:"qrSize",
h:"qrSize",
toggle:"qrToggle"
}

];


/* ===================================================== */
/* APPLY FIELD */
/* ===================================================== */

function applyField(f){

    const el = document.getElementById(f.el);

    if(!el) return;


    if(f.x){

        el.style.left =
            Number(document.getElementById(f.x).value || 0) + "px";

    }


    if(f.y){

        el.style.top =
            Number(document.getElementById(f.y).value || 0) + "px";

    }


    if(f.w){

        el.style.width =
            Number(document.getElementById(f.w).value || 0) + "px";

    }


    if(f.h){

        el.style.height =
            Number(document.getElementById(f.h).value || 0) + "px";

    }


    if(f.text){

        el.textContent =
            document.getElementById(f.text).value;

    }


    if(f.size){

        el.style.fontSize =
            Number(document.getElementById(f.size).value || 12) + "px";

    }


    if(f.color){

        el.style.color =
            document.getElementById(f.color).value;

    }


    if(f.weight){

        el.style.fontWeight =
            document.getElementById(f.weight).value;

    }


    if(f.toggle){

        const checkbox =
            document.getElementById(f.toggle);

        el.style.display =
            checkbox.checked ? "" : "none";

    }

}


/* ===================================================== */
/* WIRE CONTROLS */
/* ===================================================== */

fields.forEach(function(f){

    ["x","y","w","h","text","size","color","weight"].forEach(function(k){

        if(!f[k]) return;

        const input =
            document.getElementById(f[k]);

        if(!input) return;

        input.addEventListener("input",function(){

            applyField(f);

        });

    });


    if(f.toggle){

        document
        .getElementById(f.toggle)
        .addEventListener("change",function(){

            applyField(f);

        });

    }


    applyField(f);

});


/* ===================================================== */
/* DEFAULT FONT SETTINGS */
/* ===================================================== */

document.getElementById("elName").style.textTransform =
    "uppercase";


/* ===================================================== */
/* QR CODE */
/* ===================================================== */

let qrCode = null;

function updateQr(){

    const container =
        document.getElementById("elQr");

    container.innerHTML = "";

    const data =
        document.getElementById("qrData").value || "";

    qrCode = new QRCode(container,{

        text:data,

        width:200,

        height:200,

        correctLevel:QRCode.CorrectLevel.H

    });

}

document
.getElementById("qrData")
.addEventListener("input",updateQr);

updateQr();


/* ===================================================== */
/* IMAGE NORMALIZER */
/* ===================================================== */

function normalizeImage(file,callback){

    const reader = new FileReader();

    reader.onload = function(e){

        const img = new Image();

        img.onload = function(){

            const canvas =
                document.createElement("canvas");

            canvas.width =
                img.naturalWidth;

            canvas.height =
                img.naturalHeight;

            const ctx =
                canvas.getContext("2d");

            ctx.drawImage(
                img,
                0,
                0,
                img.naturalWidth,
                img.naturalHeight
            );

            callback(
                canvas.toDataURL("image/png"),
                canvas.width,
                canvas.height
            );

        };

        img.src = e.target.result;

    };

    reader.readAsDataURL(file);

}


/* ===================================================== */
/* BACKGROUND UPLOAD */
/* ===================================================== */

document
.getElementById("bgUpload")
.addEventListener("change",function(e){

    const file = e.target.files[0];

    if(!file) return;


    normalizeImage(file,function(dataUrl,w,h){

        CARD_W = w;
        CARD_H = h;

        card.style.width = w + "px";
        card.style.height = h + "px";

        card.style.backgroundImage =
            "url('" + dataUrl + "')";

        updatePreviewZoom();

    });

});


/* ===================================================== */
/* PHOTO UPLOAD */
/* ===================================================== */

document
.getElementById("photoUpload")
.addEventListener("change",function(e){

    const file = e.target.files[0];

    if(!file) return;


    normalizeImage(file,function(dataUrl){

        document
        .getElementById("elPhoto")
        .src = dataUrl;

    });

});


/* ===================================================== */
/* LOGO UPLOAD */
/* ===================================================== */

document
.getElementById("logoUpload")
.addEventListener("change",function(e){

    const file = e.target.files[0];

    if(!file) return;


    normalizeImage(file,function(dataUrl){

        document
        .getElementById("elLogo")
        .src = dataUrl;

    });

});


/* ===================================================== */
/* SIGNATURE UPLOAD */
/* ===================================================== */

document
.getElementById("signUpload")
.addEventListener("change",function(e){

    const file = e.target.files[0];

    if(!file) return;


    normalizeImage(file,function(dataUrl){

        const sign =
            document.getElementById("elSign");

        sign.src = dataUrl;

    });

});


/* ===================================================== */
/* DRAGGING */
/* ===================================================== */

let dragEl = null;

let offsetX = 0;

let offsetY = 0;


document
.querySelectorAll(".el")
.forEach(function(el){

    el.addEventListener("mousedown",function(e){

        dragEl = el;

        el.classList.add("dragging");


        const rect =
            card.getBoundingClientRect();


        const scale =
            rect.width / CARD_W;


        offsetX =
            (e.clientX - rect.left) / scale -
            parseFloat(el.style.left || 0);


        offsetY =
            (e.clientY - rect.top) / scale -
            parseFloat(el.style.top || 0);


        e.preventDefault();

    });

});


document.addEventListener("mousemove",function(e){

    if(!dragEl) return;


    const rect =
        card.getBoundingClientRect();


    const scale =
        rect.width / CARD_W;


    let x =
        (e.clientX - rect.left) / scale -
        offsetX;


    let y =
        (e.clientY - rect.top) / scale -
        offsetY;


    x = Math.max(0,Math.min(CARD_W,x));

    y = Math.max(0,Math.min(CARD_H,y));


    x = Math.round(x);

    y = Math.round(y);


    dragEl.style.left =
        x + "px";

    dragEl.style.top =
        y + "px";


    const field =
        fields.find(
            f => f.el === dragEl.id
        );


    if(field){

        if(field.x){

            document
            .getElementById(field.x)
            .value = x;

        }

        if(field.y){

            document
            .getElementById(field.y)
            .value = y;

        }

    }

});


document.addEventListener("mouseup",function(){

    if(dragEl){

        dragEl.classList.remove("dragging");

    }

    dragEl = null;

});


/* ===================================================== */
/* SHOW ALL */
/* ===================================================== */

document
.getElementById("showAllBtn")
.addEventListener("click",function(){

    fields.forEach(function(f){

        if(f.toggle){

            document
            .getElementById(f.toggle)
            .checked = true;

            applyField(f);

        }

    });

});


/* ===================================================== */
/* HIDE ALL */
/* ===================================================== */

document
.getElementById("hideAllBtn")
.addEventListener("click",function(){

    fields.forEach(function(f){

        if(f.toggle){

            document
            .getElementById(f.toggle)
            .checked = false;

            applyField(f);

        }

    });

});


/* ===================================================== */
/* COLLAPSIBLE GROUPS */
/* ===================================================== */

document
.querySelectorAll(".group-title")
.forEach(function(title){

    title.addEventListener("click",function(e){

        if(
            e.target.closest(".switch")
        ){

            return;

        }

        title
        .parentElement
        .classList
        .toggle("collapsed");

    });

});


/* ===================================================== */
/* ZOOM */
/* ===================================================== */

const zoom =
    document.getElementById("zoom");

const zoomVal =
    document.getElementById("zoomVal");


function updatePreviewZoom(){

    const value =
        Number(zoom.value);

    cardPreview.style.transform =
        "scale(" + value / 100 + ")";

    zoomVal.textContent =
        value + "%";

}


zoom.addEventListener(
    "input",
    updatePreviewZoom
);


/*
Default 50%.

Because the real card is 1400x900,
50% gives approximately 700x450
on screen.
*/

updatePreviewZoom();


/* ===================================================== */
/* RESET */
/* ===================================================== */

const defaults = {};

document
.querySelectorAll(".controls input,.controls select")
.forEach(function(input){

    defaults[input.id] =
        input.type === "checkbox"
        ? input.checked
        : input.value;

});


document
.getElementById("resetBtn")
.addEventListener("click",function(){

    Object.keys(defaults).forEach(function(id){

        const input =
            document.getElementById(id);

        if(input.type === "checkbox"){

            input.checked =
                defaults[id];

        }else{

            input.value =
                defaults[id];

        }

    });


    fields.forEach(applyField);

    updateQr();

});


/* ===================================================== */
/* EXPORT LAYOUT */
/* ===================================================== */

function buildLayout(){

    const layout = {

        cardWidth:CARD_W,

        cardHeight:CARD_H,

        background:
            card.style.backgroundImage,

        fields:{}

    };


    fields.forEach(function(f){

        const el =
            document.getElementById(f.el);


        layout.fields[f.key] = {

            x:parseFloat(el.style.left) || 0,

            y:parseFloat(el.style.top) || 0,

            width:
                f.w
                ? parseFloat(el.style.width) || 0
                : null,

            height:
                f.h
                ? parseFloat(el.style.height) || 0
                : null,

            fontSize:
                f.size
                ? parseFloat(el.style.fontSize) || 0
                : null,

            color:
                f.color
                ? el.style.color
                : null,

            fontWeight:
                f.weight
                ? el.style.fontWeight
                : null,

            visible:
                f.toggle
                ? document.getElementById(f.toggle).checked
                : true

        };

    });


    return layout;

}


document
.getElementById("exportLayoutBtn")
.addEventListener("click",function(){

    const layout =
        buildLayout();


    const blob =
        new Blob(
            [JSON.stringify(layout,null,2)],
            {type:"application/json"}
        );


    const url =
        URL.createObjectURL(blob);


    const a =
        document.createElement("a");

    a.href = url;

    a.download =
        "idcard-layout.json";

    a.click();


    URL.revokeObjectURL(url);

});


/* ===================================================== */
/* IMPORT LAYOUT */
/* ===================================================== */

document
.getElementById("importLayoutBtn")
.addEventListener("click",function(){

    document
    .getElementById("importLayoutFile")
    .click();

});


document
.getElementById("importLayoutFile")
.addEventListener("change",function(e){

    const file =
        e.target.files[0];

    if(!file) return;


    const reader =
        new FileReader();


    reader.onload =
        function(event){

            try{

                const layout =
                    JSON.parse(event.target.result);


                if(layout.cardWidth){

                    CARD_W =
                        layout.cardWidth;

                    CARD_H =
                        layout.cardHeight;

                    card.style.width =
                        CARD_W + "px";

                    card.style.height =
                        CARD_H + "px";

                }


                if(layout.background){

                    card.style.backgroundImage =
                        layout.background;

                }


                fields.forEach(function(f){

                    const data =
                        layout.fields?.[f.key];

                    if(!data) return;


                    if(f.x){

                        document
                        .getElementById(f.x)
                        .value = data.x ?? 0;

                    }


                    if(f.y){

                        document
                        .getElementById(f.y)
                        .value = data.y ?? 0;

                    }


                    if(f.w && data.width != null){

                        document
                        .getElementById(f.w)
                        .value = data.width;

                    }


                    if(f.h && data.height != null){

                        document
                        .getElementById(f.h)
                        .value = data.height;

                    }


                    if(f.size && data.fontSize != null){

                        document
                        .getElementById(f.size)
                        .value = data.fontSize;

                    }


                    if(f.color && data.color){

                        document
                        .getElementById(f.color)
                        .value =
                            rgbToHex(data.color);

                    }


                    if(f.toggle &&
                       data.visible != null){

                        document
                        .getElementById(f.toggle)
                        .checked =
                            data.visible;

                    }


                    applyField(f);

                });


                updatePreviewZoom();

                alert("Layout loaded successfully.");

            }
            catch(error){

                console.error(error);

                alert(
                    "Could not read the layout file."
                );

            }

        };


    reader.readAsText(file);

});


/* ===================================================== */
/* RGB TO HEX */
/* ===================================================== */

function rgbToHex(value){

    if(!value) return "#000000";

    if(value.startsWith("#"))
        return value;


    const matches =
        value.match(/\d+/g);


    if(!matches)
        return "#000000";


    return "#" +
        matches
        .slice(0,3)
        .map(function(n){

            return Number(n)
                .toString(16)
                .padStart(2,"0");

        })
        .join("");

}


/* ===================================================== */
/* DOWNLOAD PNG */
/* ===================================================== */

document
.getElementById("downloadBtn")
.addEventListener("click",async function(){

    const button =
        document.getElementById("downloadBtn");


    const oldText =
        button.innerHTML;


    button.innerHTML =
        "⏳ Generating...";

    button.disabled = true;


    try{

        /*
        IMPORTANT:

        Do NOT capture cardPreview.

        Capture idCard directly.

        This means:

        1400 x 900

        is exported at the actual card size.
        */

        const canvas =
            await html2canvas(
                card,
                {
                    scale:3,

                    useCORS:true,

                    allowTaint:false,

                    backgroundColor:null,

                    imageTimeout:15000,

                    logging:false
                }
            );


        const link =
            document.createElement("a");


        link.download =
            "id-card.png";


        link.href =
            canvas.toDataURL(
                "image/png"
            );


        link.click();


    }
    catch(error){

        console.error(
            "PNG EXPORT ERROR:",
            error
        );


        alert(
            "Could not generate the ID card image. Check the browser console for details."
        );

    }
    finally{

        button.innerHTML =
            oldText;

        button.disabled =
            false;

    }

});


/* ===================================================== */
/* INITIALIZE */
/* ===================================================== */

fields.forEach(applyField);

updateQr();

updatePreviewZoom();

})();

</script>

</body>
</html>
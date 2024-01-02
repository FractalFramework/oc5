//from index
//let state = { "page": "home" };
//const maintg = "main"
let oldj = '';

function pr(d) { return console.log(d); }
function und(d) { return typeof d == 'undefined' ? '' : d; }
function getbyid(id) { return document.getElementById(id); }
function falseClose(id) { getbyid(id).innerHTML = ''; }

function active(ob, id, a) {
    if (id) ob = getbyid(id); var op = ob.className;
    if (op.indexOf('active') == -1) { ob.classList.add("active"); return 1; }
    else if (!a) { ob.classList.remove("active"); return 0; }
}
function isactive(ob, id) {
    if (id) ob = getbyid(id); var op = ob.className;
    return op.indexOf('active') == -1 ? 0 : 1;
}

//urls
function updateurl(u, j) {
    var r = { u: u, j: j, t: '' };
    if (j != oldj) window.history.pushState(r, j, u); oldj = j;
    if ('scrollRestoration' in history) history.scrollRestoration = 'manual';
}

function restorestate(st) {
    if (!st) return;
    bjcall(st.j); document.title = st.t;
}

function startstate(st) {
    var u = document.URL; var t = document.title;
    var a = und(st.page); if (!a) a = 'home';
    var j = maintg + '|' + a + '|p1=' + und(st.p1) + ',p2=' + und(st.p2);
    var r = { u: u, j: j, t: t };
    var h = window.location.hash;
    oldj = j;
    //if(h){h=decodeURIComponent(h.substring(1)); var i=rha.get(h); r={u:u,j:j,t:t,i:i};}
    window.history.replaceState(r, j, u);
}

//window.addEventListener('popstate',function(e){restorestate(e.state);});
window.onpopstate = function (e) { restorestate(e.state); }
window.onload = function (e) { startstate(state); }

//edit
function execom(d) {
    var u = null;
    if (d == 'createLink') u = prompt('Url');
    document.execCommand(d, false, u);
}

function execom2(d) {
    document.execCommand('formatBlock', false, '<' + d + '>');
    getbyid('content').value = 'no';
}

//active list
function activeListElement(n) {
    var mnu = getbyid('adminNav').getElementsByTagName('a');
    for (i = 0; i < mnu.length; i++) {
        if (i == n) mnu[i].className = 'nav-tabs nav-link disabled';
        else mnu[i].className = 'nav-tabs nav-link';
    }
}



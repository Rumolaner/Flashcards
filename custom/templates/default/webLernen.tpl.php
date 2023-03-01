{tpl html_head}
{tpl site_head}

<main role="main">
<h1>{tpl title}</h1>
<div id="hiddenid">{tpl id}</div>
<div id="msg">{tpl msg}</msg>
<div id="content">
<div id="overlay2" style="display:{tpl oDisplay}" onclick="js_wait2(false);"><div id="oBackground">Es gibt keine unbeantworteten Fragen mehr</div></div>
    <div id="breadcrumb">{tpl kategorie}: {tpl breadcrumb}</div>
    <div id="fortschritt">{tpl fortschritt}: {tpl fortschrittValue}</div>
    <div id="question">{tpl question}
    </div>
    <div id="answer">
    </div>
    <div id="buttons">
        <button class="formfieldSubmit" onClick="todo_send()">{tpl todo}</button>
        <button class="formfieldSubmit" onClick="hinweis_send()">{tpl hinweis}</button>
        <button class="formfieldSubmit" onClick="anzeigen_send()">{tpl anzeigen}</button>
        <button class="formfieldSubmit" onClick="antworten_send(false)">{tpl nichtgewusst}</button>
        <button class="formfieldSubmit" onClick="antworten_send(true)">{tpl gewusst}</button>
    </div>
    <div id="statistik"><table>{tpl statistik}</table></div>
</div>
</main>
{tpl site_foot}
{tpl html_foot}

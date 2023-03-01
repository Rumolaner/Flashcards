{tpl html_head}
{tpl site_head}

<main role="main">
<h1>{tpl title}</h1>
{tpl msg}
<div id="message"><h2>{tpl statistiken}:</h2>
    <table>
        <tr><th>{tpl karten}:</th><td>{tpl kartenValue}</td><tr>
        <tr><th>{tpl inkategorien}:</th><td>{tpl inkategorienValue}</td><tr>
        <tr><th>{tpl offene}:</th><td>{tpl offeneValue}</td><tr>
        <tr><th>{tpl offeneMorgen}:</th><td>{tpl offeneMorgenValue}</td><tr>
        <tr><th>{tpl offeneUebermorgen}:</th><td>{tpl offeneUebermorgenValue}</td><tr>
        <tr><th>{tpl gewusst}:</th><td>{tpl gewusstValue}</td><tr>
        <tr><th>{tpl nichtgewusst}:</th><td>{tpl nichtgewusstValue}</td><tr>
        <tr><th>{tpl beantwortetDiesesJahr}:</th><td>{tpl beantwortetDiesesJahrValue}</td><tr>
        <tr><th>{tpl todo}:</th><td>{tpl todoValue}</td><tr>
    </table>
</div>
<div id="statistik"><table>{tpl statistik}</table></div>

</main>
{tpl site_foot}
{tpl html_foot}

            <div id="karte{tpl id}" style="" class="karte">
				<div id="status{tpl id}" class="status"></div>
				<label for="frage{tpl id}">{tpl frage}:</label>
				<textarea id="frage{tpl id}" class="textbox" onChange="changedStat(this)">{tpl frageValue}</textarea>
				<label for="hinweis{tpl id}">{tpl hinweis}:</label>
				<textarea id="hinweis{tpl id}" class="textbox" onChange="changedStat(this)">{tpl hinweisValue}</textarea>
				<label for="antwort{tpl id}">{tpl antwort}:</label>
				<textarea id="antwort{tpl id}" class="textbox" onChange="changedStat(this)">{tpl antwortValue}</textarea>
				<button id="btn{tpl id}" onCLick="saveFrage(this)" class="btnsave">{tpl speichern}</button> <button id="del{tpl id}" onCLick="deleteFrage(this)" class="btndel">{tpl delete}</button> <input class="todo" type="checkbox" id="todo{tpl id}" {tpl checked}><label for="todo{tpl id}">{tpl todo}</label>
			</div>

/** @license
 * Copyright (c) 2013-2017 Ephox Corp. All rights reserved.
 * This software is provided "AS IS," without a warranty of any kind.
 */
!function(){var a=function(a){return function(){return a}},b=function(a,b){var c=a.src.indexOf("?");return a.src.indexOf(b)+b.length===c},c=function(a){for(var b=a.split("."),c=window,d=0;d<b.length&&void 0!==c&&null!==c;++d)c=c[b[d]];return c},d=function(a,b){if(a){var d=a.getAttribute("data-main");if(d){a.removeAttribute("data-main");var e=c(d);if("function"==typeof e)return e;console.warn("attribute on "+b+" does not reference a global method")}else console.warn("no data-main attribute found on "+b+" script tag")}};!function(a,c){var e=d(document.currentScript,c);if(e)return e;for(var f=document.getElementsByTagName("script"),g=0;g<f.length;g++)if(b(f[g],a)){var h=d(f[g],c);if(h)return h}throw"cannot locate "+c+" script tag"}("help_hr.js","help for language hr")({version:"2.3.0",about:a('\ufeff<div role=presentation class="ephox-polish-help-article ephox-polish-help-about">\n  <div class="ephox-polish-help-h1" role="heading" aria-level="1">O programu</div>\n  <p>Textbox.io je alat WYSIWYG za stvaranje sadr\u017eaja dobrog izgleda u mre\u017enim aplikacijama. Textbox.io omogu\u0107uje ljudima da se izraze na internetu, bez obzira radi li se o dru\u0161tvenim zajednicama, blogovima, e-po\u0161ti ili bilo \u010demu drugom.</p>\n  <p>&nbsp;</p>\n  <p>Textbox.io @@FULL_VERSION@@</p>\n  <p>@@CLIENT_VERSION@@ prilago\u0111ena klijentima</p>\n  <p class="ephox-polish-help-integration">Integracija @@INTEGRATION_TYPE@@, verzija @@INTEGRATION_VERSION@@</p>\n  <p>&nbsp;</p>\n  <p>Autorsko pravo 2017. Ephox Corporation. Sva prava pridr\u017eana.</p>\n  <p><a href="javascript:void(0)" class="ephox-license-link">Licencije tre\u0107e strane</a></p>\n</div>'),accessibility:a('\ufeff<div role=presentation class="ephox-polish-help-article">\n  <div role="heading" aria-level="1" class="ephox-polish-help-h1">Navigacija na tipkovnici</div>\n  <div role="heading" aria-level="2" class="ephox-polish-help-h2">Aktivacija navigacije na tipkovnici</div>\n  <p>Da biste omogu\u0107ili navigaciju na tipkovnici na alatnoj traci, pritisnite F10 za sustav Windows ili ALT + F10 na sustavu Mac OSX. Prva stavka na alatnoj traci ozna\u010dit \u0107e se plavom konturom koja ozna\u010dava odabrano stanje. </p>\n\n  <div role="heading" aria-level="2" class="ephox-polish-help-h2">Pomicanje izme\u0111u grupa</div>\n  <p>Gumbi unutar alatne trake odvojeni su grupama sli\u010dnih radnji. Kada je navigacija na tipkovnici aktivna, pritisak na tipku tab pomaknut \u0107e odabir na sljede\u0107u grupu, a shift + tab vratit \u0107e odabir na prethodnu grupu. Pritiskom na tipku tab na zadnjoj grupi cikli\u010dki \u0107e se vratiti natrag na prvu grupu gumba.</p>\n\n  <div role="heading" aria-level="2" class="ephox-polish-help-h2">Pomicanje izme\u0111u stavki ili gumba</div>\n  <p>Da biste se prebacivali prema naprijed i unatrag izme\u0111u stavki, koristite se tipkama sa strelicama. Stavke \u0107e se cikli\u010dki kretati unutar svojih grupa, a da biste presko\u010dili na drugu grupu pritisnite tab i s pomo\u0107u tipki sa strelicama pro\u0111ite grupu.</p>\n\n  <div role="heading" aria-level="2" class="ephox-polish-help-h2">Izvr\u0161avanje naredbi</div>\n  <p>Da biste izvr\u0161ili naredbu, odaberite \u017eeljeni gumb i pritisnite space ili enter.</p>\n\n  <div role="heading" aria-level="2" class="ephox-polish-help-h2">Otvaranje, navigacija i zatvaranje izbornika</div>\n  <p>Kada gumb alatne trake sadr\u017ei izbornik, pritiskom na space ili enter otvorit \u0107e se izbornik. Kada se izbornik otvori i odabere prva stavka, za navigaciju izbornikom koristite se tipkama sa strelicama. Da biste se pomicali prema gore ili prema dolje po izborniku, pritisnite tipku sa strelicom prema gore ili prema dolje. Isto vrijedi i za podizbornike.</p>\n\n  <p>Stavke izbornika koji imaju podizbornike ozna\u010dene su simbolom \u0161evrona. Upotrebom tipke sa strelicom koja odgovara smjeru \u0161evrona podizbornik \u0107e se pro\u0161iriti, dok \u0107e tipka sa strelicom u suprotnom smjeru zatvoriti podizbornik.</p>\n\n  <p>Da biste zatvorili aktivne izbornike, pritisnite tipku escape. Kada se izbornik zatvori, odabir \u0107e se vratiti na prethodni odabir.</p>\n\n  <div role="heading" aria-level="2" class="ephox-polish-help-h2">Ure\u0111ivanje ili uklanjanje hiperveza</div>\n\n  <p>Da biste uredili ili uklonili vezu, idite na izbornik Umetni i odaberite Umetni vezu. Ure\u0111iva\u010d \u0107e prikazati dijalog za ure\u0111ivanje veze. </p>\n\n  <p>Uredite vezu unosom novog url-a u okvir za unos a\u017eurirane veze i pritisnite enter. Uklonite vezu iz dokumenta odabirom gumba za uklanjanje. Za izlaz iz dijaloga bez promjena pritisnite esc.</p>\n\n  <div role="heading" aria-level="2" class="ephox-polish-help-h2">Promjena veli\u010dine fontova i veli\u010dine granice tablice</div>\n\n  <p>Promijenite veli\u010dine fontova odlaskom na izbornik za fontove i odabirom veli\u010dine fontova. Ure\u0111iva\u010d prikazuje dijalog za veli\u010dinu u izborniku i postavlja fokus na dijalog.</p>\n\n  <p>Promijenite veli\u010dine granica odlaskom na stavku alatne trake za veli\u010dinu granice tablice i odabirom veli\u010dine granice tablice. Ure\u0111iva\u010d prikazuje dijalog za veli\u010dinu u izborniku i postavlja fokus na dijalog. Napomena: stavka alatne trake za veli\u010dinu granice tablice dostupna je samo kada je kursor unutar tablice.</p>\n\n  <p>Unutar dijaloga za veli\u010dinu, pritisnite tipku tab da biste odabir pomaknuli na sljede\u0107u komandu. Pritisnite shift+tab da biste odabir pomaknuli na prethodnu komandu.</p>\n\n  <p>Promijenite veli\u010dinu unosom nove vrijednosti u okvir za unos veli\u010dine. Primjerice, 14px ili 1em. Za slanje promjena pritisnite enter. Imajte na umu da se pritiskom na enter zatvara dijalog i fokus se vra\u0107a na dokument.</p>\n\n  <p>Promijenite veli\u010dinu bez izlaska iz dijaloga aktivacijom gumba za pove\u0107avanje ili smanjivanje veli\u010dine. Mijenjanjem veli\u010dine s pomo\u0107u gumba za pove\u0107avanje ili smanjivanje veli\u010dine odmah \u0107e se promijeniti veli\u010dina odabranog elementa, a zadr\u017eat \u0107e se trenutna vrijednost jedinice. Iza\u0111ite iz dijaloga za veli\u010dinu pritiskom na esc.</p>\n\n  <div role="heading" aria-level="2" class="ephox-polish-help-h2">Obrezivanje slike</div>\n\n  <p>Da biste pristupili zna\u010dajci obrezivanja, odaberite sliku za prikaz radnji slike na alatnoj traci. Ove su radnje dostupne i u kontekstom izborniku. Kada se obrezivanje aktivira, maska za obrezivanje postavit \u0107e se na vrh slike i odabrat \u0107e se gornji lijevi kut.</p>\n\n  <p>Kre\u0107ite se s pomo\u0107u tipke tab. Mo\u017ee se odabrati svaki od 4 kuta, kao i cijeli okvir maske za obrezivanje. Svaki se kut mo\u017ee zasebno postaviti ili se svi kutovi mogu pomaknuti u isto vrijeme pomicanjem cijelog okvira maske za obrezivanje.</p>\n\n  <p>Pomicanje odabira po slici obavlja se s pomo\u0107u tipki sa strelicama. Svakim pritiskom na tipku sa strelicom do\u0107i \u0107e do pomaka od 10 piksela, a za manje pomake dr\u017eite shift dok priti\u0161\u0107ete tipku sa strelicom da biste se pomaknuli za jedan piksel.</p>\n\n  <p>Da biste primijenili obrezivanje na sliku, pritisnite enter.</p>\n\n  <p>Da biste otkazali obrezivanje bez u\u010dinka na sliku, pritisnite tipku ESC.</p>\n\n  <table aria-readonly="true" cellpadding="0" cellspacing="0" class="ephox-polish-tabular ephox-polish-help-table ephox-polish-help-table-shortcuts">\n      <caption>Navigacija na tipkovnici</caption>\n      <thead>\n        <tr>\n          <th scope="col">Radnja</th>\n          <th scope="col">Windows</th>\n          <th scope="col">Mac OS</th>\n        </tr>\n      </thead>\n      <tbody>\n      <tr>\n        <td>Aktiviraj alatnu traku</td>\n        <td>F10</td>\n        <td>ALT + F10</td>\n      </tr>\n      <tr>\n        <td>Odaberi gumb za sljede\u0107u/prethodnu grupu</td>\n        <td>\u2190 ili \u2192</td>\n        <td>\u2190 ili \u2192</td>\n      </tr>\n      <tr>\n        <td>Pomakni se na sljede\u0107u grupu</td>\n        <td>TAB</td>\n        <td>TAB</td>\n      </tr>\n      <tr>\n        <td>Pomakni se na prethodnu grupu</td>\n        <td>SHIFT + TAB</td>\n        <td>SHIFT + TAB</td>\n      </tr>\n      <tr>\n        <td>Izvr\u0161i naredbu</td>\n        <td>SPACE ili ENTER</td>\n        <td>SPACE ili ENTER</td>\n      </tr>\n      <tr>\n        <td>Otvaranje glavnog izbornika</td>\n        <td>SPACE ili ENTER</td>\n        <td>SPACE ili ENTER</td>\n      </tr>\n      <tr>\n        <td>Otvaranje/pro\u0161irivanje podizbornika</td>\n        <td>SPACE ili ENTER ili \u2192</td>\n        <td>SPACE ili ENTER ili \u2192</td>\n      </tr>\n      <tr>\n        <td>Odaberi sljede\u0107u/prethodnu stavku izbornika</td>\n        <td>\u2193 ili \u2191</td>\n        <td>\u2193 ili \u2191</td>\n      </tr>\n      <tr>\n        <td>Zatvori izbornik</td>\n        <td>ESC</td>\n        <td>ESC</td>\n      </tr>\n      <tr>\n        <td>Zatvaranje/sa\u017eimanje podizbornika</td>\n        <td>ESC ili \u2190</td>\n        <td>ESC ili \u2190</td>\n      </tr>\n      <tr>\n        <td>Pomicanje odabira obrezivanja slike</td>\n        <td>\u2190 ili \u2192 ili \u2193 ili \u2191</td>\n        <td>\u2190 ili \u2192 ili \u2193 ili \u2191</td>\n      </tr>\n      <tr>\n        <td>Precizno pomicanje odabira obrezivanja slike</td>\n        <td>Dr\u017eite SHIFT tijekom pomicanja</td>\n        <td>Dr\u017eite SHIFT tijekom pomicanja</td>\n      </tr>\n      <tr>\n        <td>Primjena obrezivanja</td>\n        <td>ENTER</td>\n        <td>ENTER</td>\n      </tr>\n      <tr>\n        <td>Otkazivanje obrezivanja</td>\n        <td>ESC</td>\n        <td>ESC</td>\n      </tr>\n    </tbody>\n  </table>\n</div>\n'),a11ycheck:a('\ufeff<div role=presentation class="ephox-polish-help-article">\n  <div role="heading" aria-level="1" class="ephox-polish-help-h1">Provjera pristupa\u010dnosti</div>\n  <p>Alat za provjeru pristupa\u010dnosti (ako je omogu\u0107en) mo\u017ee identificirati sljede\u0107e probleme pristupa\u010dnosti u HTML dokumentima.</p>\n  <table aria-readonly="true" cellpadding="0" cellspacing="0" class="ephox-polish-tabular ephox-polish-a11ycheck-table">\n      <caption>Definicija problema</caption>\n      <thead>\n        <tr>\n          <th scope="col">Problem</th>\n          <th scope="col">WCAG</th>\n          <th scope="col">Opis</th>\n        </tr>\n      </thead>\n      <tbody>\n      <tr>\n        <td>Slike moraju imati alternativan tekstualni opis</td>\n        <td>1.1.1</td>\n        <td>Slike moraju imati postavljenu vrijednost alternativnog teksta koji opisuje temu slike korisnicima s o\u0161te\u0107enjem vida. </td>\n      </tr>\n      <tr>\n        <td>Alternativni tekst ne smije biti isti kao i naziv datoteke slike</td>\n        <td>1.1.1</td>\n        <td>Izbjegavajte upotrebu naziva datoteke slike u vrijednosti alternativnog teksta. Odaberite vrijednost alternativnog teksta koja opisuje temu slike.</td>\n      </tr>\n      <tr>\n        <td>Tablice moraju imati natpise</td>\n        <td>1.3.1</td>\n        <td>Tablice moraju imati kratak opisan tekst koji ozna\u010dava sadr\u017eaje tablice.</td>\n      </tr>\n      <tr>\n        <td>Slo\u017eene tablice moraju imati sa\u017eetke</td>\n        <td>1.3.1</td>\n        <td>Tablice sa slo\u017eenim strukturama (\u0107elije koje se prote\u017eu na nekoliko redova ili stupaca) moraju uklju\u010divati sa\u017eetak koji opisuje strukturu tablice. </td>\n      </tr>\n      <tr>\n        <td>Natpis tablice i sa\u017eetak ne smiju imati istu vrijednost</td>\n        <td>1.3.1</td>\n        <td>Natpis tablice mora opisivati sadr\u017eaj tablice, dok sa\u017eetak tablice treba opisivati strukturu slo\u017eenih tablica. </td>\n      </tr>\n      <tr>\n        <td>Tablice moraju imati najmanje jednu \u0107eliju zaglavlja</td>\n        <td>1.3.1</td>\n        <td>Tablice moraju imati odgovaraju\u0107a zaglavlja redova ili stupaca koja opisuju sadr\u017eaj reda ili stupca.<br/><a href="http://webaim.org/techniques/tables/data#th" target="_blank">Vi\u0161e informacija o ovoj temi (webaim.org).</a> </td>\n      </tr>\n      <tr>\n        <td>Zaglavlja tablice moraju se upotrijebiti na red ili stupac</td>\n        <td>1.3.1</td>\n        <td>Zaglavlja tablica moraju se pridru\u017eiti redu ili stupcu koji opisuju.<br/><a href="http://webaim.org/techniques/tables/data#th" target="_blank">Vi\u0161e informacija o ovoj temi (webaim.org).</a> </td>\n      </tr>\n      <tr>\n        <td>Ovaj odlomak izgleda kao zaglavlje. Ako je zaglavlje, odaberite razinu zaglavlja.</td>\n        <td>1.3.1</td>\n        <td>S pomo\u0107u zaglavlja podijelite dokumente na sekcije. Izbjegavajte upotrebu formatiranih odlomaka kao zaglavlja.<br/><a href="http://webaim.org/techniques/semanticstructure/#correctly" target="_blank">Vi\u0161e informacija o ovoj temi (webaim.org).</a> </td>\n      </tr>\n      <tr>\n        <td>Zaglavlja se moraju primjenjivati uzastopnim redoslijedom. Primjerice: Zaglavlje 1 trebalo bi do\u0107i nakon Zaglavlja 2, a ne Zaglavlja 3.</td>\n        <td>1.3.1</td>\n        <td>Zaglavlja narednih dokumenata moraju se pojavljivati hijerarhijski, uzlaznim ili ekvivalentnim redoslijedom.<br/><a href="http://webaim.org/techniques/semanticstructure/#contentstructure" target="_blank">Vi\u0161e informacija o ovoj temi (webaim.org).</a> </td>\n      </tr>\n      <tr>\n        <td>Koristite se obilje\u017ejima popisa za popise</td>\n        <td>1.3.1</td>\n        <td>Osigurajte da popis stavki upotrebljava HTML strukturu popisa za reprezentaciju popisa(<code>&lt;ul&gt;</code> ili <code>&lt;ol&gt;</code> i <code>&lt;li&gt;</code>).</td>\n      </tr>\n      <tr>\n        <td>Tekst mora imati omjer kontrasta 4,5:1</td>\n        <td>1.4.3</td>\n        <td>Tekst i njegova pozadina moraju imati takav omjer kontrasta da ga mogu \u010ditati osobe s relativno slabim vidom.</td>\n      </tr>\n      <tr>\n        <td>Susjedne se veze trebaju spojiti.</td>\n        <td>2.4.4</td>\n        <td>Susjedne hiperveze koje upu\u0107uju na isti resurs trebaju se spojiti u jednu hipervezu.</td>\n      </tr>\n    </tbody>\n  </table>\n  <div role="heading" aria-level="2" class="ephox-polish-help-h2">Vi\u0161e informacija</div>\n  <p>\n    <a href="http://webaim.org/intro/" target="_blank">Uvod u pristupa\u010dnost web-u (webaim.org)</a> <br/>\n    <a href="http://www.w3.org/WAI/intro/wcag" target="_blank">Uvod u WCAG 2,0 (w3.org)</a> <br/>\n    <a href="http://www.section508.gov/" target="_blank">Poglavlje 508. Zakona SAD-a o rehabilitaciji (section508.gov)</a>\n  </p>\n</div>'),markdown:a('\ufeff<div role=presentation class="ephox-polish-help-article">\n  <div class="ephox-polish-help-h1" role="heading" aria-level="1">Oblikovanje s markdownom</div>\n  <p>Markdown je sintaksa za stvaranje struktura HTML-a i oblikovanje bez upotrebe pre\u010daca na tipkovnici ili izbornika za pristup. Da biste se koristili oblikovanjem s markdownom, unesite \u017eeljenu sintaksu pa pritisnite tipku enter ili razmak.</p>\n  <table cellpadding="0" cellspacing="0" class="ephox-polish-tabular ephox-polish-help-table ephox-polish-help-table-markdown" aria-readonly="true">\n      <caption>Sintaksa za oblikovanje tipkovnice</caption>\n      <thead>\n        <tr>\n          <th scope="col">Sintaksa</th>\n          <th scope="col">Rezultat u HTML-u</th>\n        </tr>\n      </thead>\n      <tbody>\n      <tr>\n        <td><pre># Najve\u0107e zaglavlje</pre></td>\n        <td><pre>&lt;h1&gt; Najve\u0107e zaglavlje&lt;/h1&gt;</pre></td>\n      </tr>\n      <tr>\n        <td><pre>## Ve\u0107e zaglavlje</pre></td>\n        <td><pre>&lt;h2&gt;Ve\u0107e zaglavlje&lt;/h2&gt;</pre></td>\n      </tr>\n      <tr>\n        <td><pre>### Veliko zaglavlje</pre></td>\n        <td><pre>&lt;h3&gt;Veliko zaglavlje&lt;/h3&gt;</pre></td>\n      </tr>\n      <tr>\n        <td><pre>####  Zaglavlje</pre></td>\n        <td><pre>&lt;h4&gt;Zaglavlje&lt;/h4&gt;</pre></td>\n      </tr>\n      <tr>\n        <td><pre>##### Malo zaglavlje</pre></td>\n        <td><pre>&lt;h5&gt;Malo zaglavlje&lt;/h5&gt;</pre></td>\n      </tr>\n      <tr>\n        <td><pre>###### Najmanje zaglavlje</pre></td>\n        <td><pre>&lt;h6&gt;Najmanje zaglavlje&lt;/h6&gt;</pre></td>\n      </tr>\n      <tr>\n        <td><pre>* Neure\u0111eni popis</pre></td>\n        <td><pre>&lt;ul&gt;&lt;li&gt;Neure\u0111eni popis&lt;/li&gt;&lt;/ul&gt;</pre></td>\n      </tr>\n      <tr>\n        <td><pre>1. Ure\u0111eni popis</pre></td>\n        <td><pre>&lt;ol&gt;&lt;li&gt;Ure\u0111eni popis&lt;/li&gt;&lt;/ol&gt;</pre></td>\n      </tr>\n      <tr>\n        <td><pre>*Kurziv*</pre></td>\n        <td><pre>&lt;em&gt;Kurziv&lt;/em&gt;</pre></td>\n      </tr>\n      <tr>\n        <td><pre>**Podebljano**</pre></td>\n        <td><pre>&lt;strong&gt;Podebljano&lt;/strong&gt;</pre></td>\n      </tr>\n      <tr>\n        <td><pre>---</pre></td>\n        <td><pre>&lt;hr/&gt;</pre></td>\n      </tr>\n    </tbody>\n  </table>\n</div>'),shortcuts:a('\ufeff<div role=presentation class="ephox-polish-help-article">\n  <div role="heading" aria-level="1" class="ephox-polish-help-h1">Pre\u010daci na tipkovnici</div>\n  <table aria-readonly="true" cellpadding="0" cellspacing="0" class="ephox-polish-tabular ephox-polish-help-table ephox-polish-help-table-shortcuts">\n    <caption>Naredbe ure\u0111iva\u010da</caption>\n    <thead>\n      <tr>\n        <th scope="col">Radnja</th>\n        <th scope="col">Windows</th>\n        <th scope="col">Mac OS</th>\n      </tr>\n    </thead>\n    <tbody>\n      <tr>\n        <td>Poni\u0161ti</td>\n        <td>CTRL + Z</td>\n        <td>\u2318Z</td>\n      </tr>\n      <tr>\n        <td>Ponovi</td>\n        <td>CTRL + Y</td>\n        <td>\u2318\u21e7Z</td>\n      </tr>\n      <tr>\n        <td>Podebljano</td>\n        <td>CTRL + B</td>\n        <td>\u2318B</td>\n      </tr>\n      <tr>\n        <td>Kurziv</td>\n        <td>CTRL + I</td>\n        <td>\u2318I</td>\n      </tr>\n      <tr>\n        <td>Podcrtano</td>\n        <td>CTRL + U</td>\n        <td>\u2318U</td>\n      </tr>\n      <tr>\n        <td>Uvlaka</td>\n        <td>CTRL + ]</td>\n        <td>\u2318]</td>\n      </tr>\n      <tr>\n        <td>Smanji uvlaku</td>\n        <td>CTRL + [</td>\n        <td>\u2318[</td>\n      </tr>\n      <tr>\n        <td>Dodaj vezu</td>\n        <td>CTRL + K</td>\n        <td>\u2318K</td>\n      </tr>\n      <tr>\n        <td>Na\u0111i</td>\n        <td>CTRL + F</td>\n        <td>\u2318F</td>\n      </tr>\n      <tr>\n        <td>Na\u010din punog zaslona (Uklju\u010di/isklju\u010di)</td>\n        <td>CTRL + SHIFT + F</td>\n        <td>\u2318\u21e7F</td>\n      </tr>\n      <tr>\n        <td>Dijalog za pomo\u0107 (otvoren)</td>\n        <td>CTRL + SHIFT + H</td>\n        <td>\u2303\u2325H</td>\n      </tr>\n      <tr>\n        <td>Kontekstni izbornik (otvoren)</td>\n        <td>SHIFT + F10</td>\n        <td>\u21e7F10\u200e\u200f</td>\n      </tr>\n      <tr>\n        <td>Kod za automatsko ispunjavanje</td>\n        <td>CTRL + Space</td>\n        <td>\u2303Space</td>\n      </tr>\n      <tr>\n        <td>Dostupan prikaz koda</td>\n        <td>CTRL + SHIFT + U</td>\n        <td>\u2318\u2325U</td>\n      </tr>\n    </tbody>\n  </table>\n  <div class="ephox-polish-help-note" role="note">*Napomena: neke zna\u010dajke mo\u017ee onemogu\u0107iti va\u0161 administrator.</div>\n</div>\n')})}();
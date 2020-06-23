let auto;

class SubText {

    constructor(txt,trenner) {
        this.text = txt;
        this.trenner = trenner;
        this.IsOpener = false;
        this.IsCloser = false;
        this.IsAllergene = false;

        this.isParent = false;
        this.prefix = "";
        this.suffix = "";
        this.parent = "";

        this.arrySubText = [];

        this.ErgebArrForSearch = [];
    }
    isNumber(t){
        let tmp = this.text;
        if(t && t != "")
            tmp = t;
        tmp = tmp.replace("%","");
        return!isNaN(tmp);
    }
    countChilds(){
        let anz = 0;
        for(var o = 0;o < this.arrySubText.length;o++){
            if(this.arrySubText[o].text != "")
                anz++;
        }
        return anz;
    }
    entferneProzente(){
        let tmp = this.text;
        let re = "";
        if(tmp.indexOf(" ") > -1){
            let res = tmp.split(" ");
            for(let i = 0;i < res.length;i++){
                if( re != "" )
                    re += " ";
                if(!this.isNumber(res[i]))
                    re += res[i];
            }
            this.text = re;
            this.trennePreSuffixLeer();
        }
    }
    entferneZeichen(z){
        let tmp = this.text;
        while(tmp.indexOf(z) > -1)
            tmp = tmp.replace(z,"")
        this.text = tmp;
    }
    addSub(obj) {
        this.arrySubText.push(obj);
    }
    trennePreSuffixLeer(){
        this.prefix = this.anzLeerStart(this.text);
        this.text = this.text.substring(this.prefix.length,this.text.length);

        this.suffix = this.anzLeerEnd(this.text);
        this.text = this.text.substring(0,this.text.length-this.suffix.length);
    }
    anzLeerStart(ori){
        let anz = "";
        for(let i = 0; i < ori.length;i++ ){
            let z = ori.substring(i,i + 1);
            if(z == " ")
                anz += " ";
            else return anz;
        }
        return anz;
    }
    anzLeerEnd(ori){
        let anz = "";
        for(let i = ori.length-1; i > 0;i-- ) {
            let z = ori.substring(i,i + 1);
            if(z == " ")
                anz += " ";
            else return anz;
        }
        return anz;
    }
}
class NahrwertTabelle {
    constructor() {
        this.ArrReihenfolge = [];
        this.ArrAlle = [];
        this.c = 0;
    }
    addNahrwertReihelfolge(){
        let textAll = document.getElementById("naehrwertereihenfolge").innerHTML;
        this.ArrReihenfolge = textAll.split(';;');
    }
    getAllMitTxt(txt){
        let tabhtml = "";
        let tt = this;
        let re = "";
        let id = 0;
        this.ArrAlle.forEach(function (item,key) {
            if(item[4] == "" )
                return;
            if(item[4] == txt) {

                re = '<div style="margin: 0px; padding: 1px 5px; line-height: 18px; height: 18px; background-color: #84A9E4;">';
                if (tt.c++ % 2 != 0) {
                    re = '<div style="margin: 0px; padding: 1px 5px; line-height: 18px; height: 18px; background-color: #DCDCDC;">';
                }
                re += "<span>" + item[0] + "</span>";
                re += "<span style='float: right;'><input readonly type='button' value='del' onclick=delNaehrwert('"+key+"');></span>";
                re += "<span style='float: right;'><input readonly type='text' value='" + item[1] + "' size='14'></span>";
                re += "<span style='float: right;'><input readonly type='text' value='" + item[2] + "' size='5'></span>";
                re += "<span style='float: right;'><input readonly type='text' value='" + item[3] + "' size='7'></span>";
                re += "</div>";
                tabhtml += re;
            }
            id++;
        });
        return tabhtml;
    }
    showAlle(){
        document.getElementById("idNaehrwetTabelle").innerHTML = "";

        let tabhtml = "";
        let tt = this;
        this.ArrReihenfolge.forEach(function (txt) {
            tabhtml += tt.getAllMitTxt(txt);
        });
        document.getElementById("idNaehrwetTabelle").innerHTML = tabhtml;
    }
    delItem(id){
        delete this.ArrAlle[id];
        document.getElementById("naehrwertedb").value = "";
        this.ArrAlle.forEach(function (item,key) {
            //if(item[4] == "" )
            let s = "";
            s += item[0] + "#;#";
            s += item[1] + "#;#";
            s += item[2] + "#;#";
            s += item[3] + "#;#";
            s += item[4] + "#;#";
            s += item[5] + "#;#";
            s += item[6] + "##;;##";
            document.getElementById("naehrwertedb").value += s;
        });

        //document.getElementById("naehrwertedb").value += typText+"#;#"+unitText+"#;#"+val+"#;#"+caText+"#;#"+typ.value+"#;#"+unit.value+"#;#"+ca.value+"##;##";


    }
    addFromDb(){
        let tt = this;

        let textAll = document.getElementById("naehrwertedb").value;
        let arrItems = textAll.split('##;;##');
        this.ArrAlle = [];
        arrItems.forEach(function (item) {
           let vals = item.split('#;#');
           if(vals[0] != "")
                tt.addNewItem(vals[0],vals[1],vals[2],vals[3],vals[4],vals[5],vals[6]);
        });
    }
    addNewItem(txt,val,unit,ca,type,unit_type,ca_type) {
        let newItem = new Array(txt,val,unit,ca,type,unit_type,ca_type);
        this.ArrAlle.push(newItem);
    }
}
class AutoText {
    constructor(txt) {
        this.oriTxt = txt;
        this.ausgabeTxt = "";

        this.arrySplitter = [];
        this.arryStarter = [];
        this.arryEnder = [];

        this.ErgebArr = [];
        this.ErgebArrDB = [];

        this.ArrIgnoreIngredienz = [];
        this.ArrAddExtraIngredienz = [];

        this.ArrAutoEdit = [];

        this.ArrAllergene = [];
        this.AllIngredienzDB = "";
        this.AllIgnoreIngredienzDB = "";

        this.bAuchHeaders = false;
        this.bMitDoppelte = false;
        this.bAllChields = true;

        this.ListSubText = [];
    }
    addAllergene(s){
        this.ArrAllergene.push(s);
    }

    addAutoEditsFromDB(){
        let textAll = document.getElementById("allAutoEdit").value;
        let arrItems = textAll.split(';');
        let tmpThis = this;

        arrItems.forEach(function (item) {
            let arr2 = item.split('-#-');
            if(arr2.length == 2)
                tmpThis.addIgnoreAutoEdit(arr2[0],arr2[1]);
        });

    }
    addIgnoreAllwaysFromDB(){
        let textAll = document.getElementById("allIgnoreAllways").value;
        let arrItems = textAll.split(';');
        let tmpThis = this;

        arrItems.forEach(function (item) {
            let arrItem = item.split('-#-');
            if(item != '')
                tmpThis.addIgnoreAllwaysIngredienz(item);
        });
    }

    loadAllergeneFromDB(textAll){
        let allergene = textAll.split(';');
        let thisTmp = this;
        allergene.forEach(function(ss) {
            if(ss != "")
                thisTmp.addAllergene(ss);
        });
    }
    addErgDB(s) {
        if(this.ErgebArrDB.indexOf(s) < 0 && s != "") {
            this.ErgebArrDB.push(s);
            this.addToErkanntDB(s)
        }
    }
    addSplitToHtml(element,stringSplitt){
        let tmp = document.getElementById(element).innerHTML;
        tmp += "<input type='button' style='margin:2px;height:23px;font-size:larger;background: #91bb9e;border: 1px solid #91bb9e;border-radius: 3px;' " +
            "value='"+stringSplitt+"' onclick=deleteSplitter('"+element+"','"+stringSplitt+"');>";
        document.getElementById(element).innerHTML = tmp;
    }
    addSpiltterTrenner(s) {
        this.arrySplitter.push(s);
    }
    addStarter(s) {
        this.arryStarter.push(s);
    }
    addIgnoreOneTimeIngredienz(s){
        this.ArrIgnoreIngredienz.push(s);
        let index = this.ArrAddExtraIngredienz.indexOf(s);
        delete this.ArrAddExtraIngredienz[index];
    }
    addIgnoreAllwaysIngredienz(s){
        this.ArrIgnoreIngredienz.push(s);
        let index = this.ArrAddExtraIngredienz.indexOf(s);
        delete this.ArrAddExtraIngredienz[index];
    }
    addIgnoreAutoEdit(sFrom,sTo){
        var item = [sFrom, sTo];
        this.ArrAutoEdit.push(item);
    }
    addIngredienzNow(s){
        this.ArrAddExtraIngredienz.push(s);
        let index = this.ArrIgnoreIngredienz.indexOf(s);
        delete this.ArrIgnoreIngredienz[index];
    }
    addEnder(s) {
        this.arryEnder.push(s);
    }
    delSpiltterTrenner(s) {
        let index = this.arrySplitter.indexOf(s);
        delete this.arrySplitter[index];
    }
    delStarter(s) {
        let index = this.arryStarter.indexOf(s);
        delete this.arryStarter[index];
    }
    delEnder(s) {
        let index = this.arryEnder.indexOf(s);
        delete this.arryEnder[index];
    }
    delAusArray(arr,s){
        let index = arr.indexOf(s);
        delete arr[index];
    }
    addToArrayStarter(s) {
        this.arryStarter.push(s);
    }
    isAllergen(such){
        for ( let i = 0; i < this.ArrAllergene.length;i++ )
        {
            let ss = this.ArrAllergene[i];
            if(such.toLowerCase().indexOf(ss.toLowerCase()) > -1)
                return true;
        }
    }
    showSplitter() {
        let thisTmp = this;
        document.getElementById("Splitter").innerHTML = "";
        this.arrySplitter.forEach(function(ss) {
            thisTmp.addSplitToHtml("Splitter",ss);
        });
        document.getElementById("SplitterStart").innerHTML = "";
        this.arryStarter.forEach(function(ss) {
            thisTmp.addSplitToHtml("SplitterStart",ss);
        });
        document.getElementById("SplitterEnd").innerHTML = "";
        this.arryEnder.forEach(function(ss) {
            thisTmp.addSplitToHtml("SplitterEnd",ss);
        });
    }

    showItem(item,thisTmp,color,parentChieldCount){

        let listErgeb = "";
        let bToDB = true;
        item.entferneZeichen("*");
        item.entferneZeichen("\n");
        item.entferneZeichen("\r");
        item.entferneZeichen("\r\n");
        if( item.text.indexOf("%") > -1 ) {
            item.entferneProzente();
        }
        item.text = str_replace("  "," ",item.text);

        //falls auto edit wandeln wir um
        for(var i = 0;i < thisTmp.ArrAutoEdit.length;i++){

            let tmp = thisTmp.ArrAutoEdit[i][0];

            if(thisTmp.ArrAutoEdit[i][0] == item.text)
                item.text = thisTmp.ArrAutoEdit[i][1];
        }

        if (thisTmp.ErgebArrForSearch.indexOf(item.text) > 0 && !thisTmp.bMitDoppelte)
            bToDB = false;
        if (item.text == "Zutaten")
            bToDB = false;
        if (!thisTmp.bAuchHeaders && item.IsOpener)
            bToDB = false;

        if(thisTmp.AllIngredienzDB.indexOf(item.text) < 0)
        {
            if(parentChieldCount == 1 && !thisTmp.bAllChields)
                return "";
        }

        if(item.isNumber())  bToDB = false;                       //ignore da text eien zahl ist
        if (item.text == "") bToDB = false;                       //ignore leere texte

        if (item.IsAllergene == true)               //allergene andere Farbe
            color = "#88ccff";

        thisTmp.ErgebArrForSearch.push(item.text);  //add to search array

        listErgeb += item.prefix;

        if(item.countChilds() == 1) {               //wir haben chield elemente
            if(item.arrySubText[0].isNumber()) {
                item.arrySubText[0].text = "";
                if (item.IsOpener && bToDB == false)
                    bToDB = true;
            }else{
                bToDB = true;
            }
        }
        if(bToDB == false && item.text != '')                  // schauen ob wohl nicht anzuzeigen trozdem da in db wo anderst vorhanden ist
        {
            if(thisTmp.AllIngredienzDB.indexOf(item.text) > -1)
                bToDB = true;
        }
        for(let anzAdd = 0 ;anzAdd < thisTmp.ArrAddExtraIngredienz.length;anzAdd++  ){          // text hinzufügen da user wunsch - rechts klick
            let addThis = thisTmp.ArrAddExtraIngredienz[anzAdd];
            if (item.text == addThis)
                bToDB = true;
        }
        for(let anzIgnor = 0 ;anzIgnor < thisTmp.ArrIgnoreIngredienz.length;anzIgnor++  ){      //text ignorieren von sonder elementen
            let ignoreThis = thisTmp.ArrIgnoreIngredienz[anzIgnor];
            if (item.text == ignoreThis)
                bToDB = false;
        }

        if (bToDB)                                                                                          //hier markieren wir die texte mit farbe und ausgegeben
            listErgeb += "<d id='ingredienzmenu' name='"+item.text+"' style='background:" + color + ";'>";
        else
            listErgeb += "<d id='ingredienzmenu' name='"+item.text+"' >";
        listErgeb += item.text;
        listErgeb += "</d>";                                                                               // ausgabe ende

        listErgeb += item.suffix;                           //suffix und trenner anzeigen
        var hidetrenner = false;
        if(item.countChilds() <= 1 && item.IsOpener && !thisTmp.bAllChields)
            hidetrenner = true;
        if(!hidetrenner)
            listErgeb += item.trenner;

        if (item.text == "Zutaten")             // text Zutaten am start anderst handhaben
            listErgeb += "<br>";

        if(bToDB) {                             // add to erkannt
            thisTmp.addToErkanntNew(item.text);
            thisTmp.addToErkannt(item.text);
        }

        //sub textes
        let subTexte = "";
        for(var o = 0;o < item.arrySubText.length;o++){
            subTexte += thisTmp.showItem(item.arrySubText[o],thisTmp,color,item.countChilds());
        }
        if(subTexte != "") {
            if(hidetrenner)
                listErgeb += item.trenner;
            listErgeb += subTexte;
        }

        return listErgeb;
    }
    showErgebnisse(){
        let listErgeb = "";
        let i = 0;
        let color = "#ffff42";
        let thisTmp = this;
        this.ErgebArrForSearch = [];

        document.getElementById("act_ingrdients").innerHTML = "";
        document.getElementById("new_ingrdients").innerHTML = "";
        document.getElementById("ausgabeNew").innerHTML = "";
        document.getElementById("tosaveindb").innerHTML = "";
        this.ListSubText.forEach(function(item){

                listErgeb += thisTmp.showItem(item,thisTmp,color);
                if (i++ == 0) {
                    i == 1;
                    color = "#55ff42";
                } else {
                    i = 0;
                    color = "#ffff42";
                }
        });

        document.getElementById("ausgabeNew").innerHTML = listErgeb;

    }
    addToErkanntDB(txt){
        let element= "old_ingrdients";
        let tmp = document.getElementById(element).innerHTML;
        tmp += "<div style='width: 95% !important;'> "+txt+" </div>";
        document.getElementById(element).innerHTML = tmp;
    }
    addToErkanntNew(txt){
        let element= "new_ingrdients";
        let tmp = document.getElementById(element).innerHTML;
        tmp += "<div style='width: 95% !important;'> "+txt+" </div>";
        document.getElementById(element).innerHTML = tmp;
        //this.addToSave(txt,"new_ingrdients");
        addToSaveElement(txt,'new_ingrdients','tosaveindb');
    }
    addToErkannt(txt){
        let element= "act_ingrdients";
        let tmp = document.getElementById(element).innerHTML;
        tmp += "<div class='ingred_div'> "+txt+" </div>";
        document.getElementById(element).innerHTML = tmp;
    }
    reset(){
        this.ErgebArr = [];
        this.ListSubText = [];
        document.getElementById("act_ingrdients").innerHTML = "";
        //document.getElementById("old_ingrdients").innerHTML = "";
        document.getElementById("new_ingrdients").innerHTML = "";
        document.getElementById("ausgabeNew").innerHTML = "";


    }
    loadAllIngredienzDB(textAll){
        this.AllIngredienzDB = textAll;
    }
    loadErgFromDB(textAll){
        let words = textAll.split(';');
        let thisTmp = this;
        words.forEach(function(ss) {
            thisTmp.addErgDB(ss);
        });
    }

    teileAlle(){

        this.reset();
        let tmpStr = this.oriTxt+",";
        //this.firstSubTexte = new SubText('','');
        let subText = "";
        let parentText = "";
        while(tmpStr.length > 0) {
            if(subText == "")
                subText = new SubText('','');

            let s = tmpStr.substring(0,1);
            if(this.arrySplitter.indexOf(s) > -1) {     //Trenner gefunden
                subText.trenner += s;
            }
            else{
                subText.text += s;
            }

            //wir haben text und ein ende dazu == neu machen
            if(subText.text != "" && subText.trenner != "") {
                subText.trennePreSuffixLeer();
                //this.ErgebArr.push(subText);
                if(this.isAllergen(subText.text))
                    subText.IsAllergene = true;

                if(this.arryStarter.indexOf(s) > -1) {  //wir sind eröffner
                    subText.IsOpener = true;
                    subText.isParent = true;
                    parentText = subText;
                }
                if(this.arryEnder.indexOf(s) > -1) { // wir sind closer
                    subText.IsCloser = true;
                    subText.isParent = false;
                    //parentText = "";
                }

                if(!subText.isParent && parentText != "") {     // add to Parent
                    subText.parent = parentText;
                    parentText.addSub(subText);
                    if(subText.IsCloser)
                        parentText = "";
                }
                else {
                    this.ListSubText.push(subText);
                }
                subText = "";
            }
            if(subText.text == "" && subText.trenner != "") {
                subText = "";
            }

            tmpStr = tmpStr.substring(1);
        }
        this.showErgebnisse();
    }
}

function addToSaveElement(ss,type,id){
    document.getElementById(id).innerHTML += ss + ";";
}

function toggleMitHeader(){
    auto.bAuchHeaders = !auto.bAuchHeaders;
    auto.showErgebnisse();
}
function toggleMitDoppelte(){
    auto.bMitDoppelte = !auto.bMitDoppelte;
    auto.showErgebnisse();
}
function toggleMitChields(){
    auto.bAllChields = !auto.bAllChields;
    auto.showErgebnisse();
}

function addnewSpitt(grp) {
    let s = document.getElementById(grp+"Input").value;
    if(s == "")
    {
        alert("Es wurde kein Zeichen angegeben");
        return;
    }
    if(grp == "Splitter") {
        auto.addSpiltterTrenner(s);
        auto.showSplitter();
    }
    if(grp == "SplitterStart") {
        auto.addStarter(s);
        auto.showSplitter();
    }
    if(grp == "SplitterEnd") {
        auto.addEnder(s);
        auto.showSplitter();
    }
    auto.teileAlle();
}
function deleteSplitter(grp,element){
    let check = confirm('Wollen Sie dieses Element wirklich löschen?');
    if (check == true) {
        if(grp == "Splitter") {
            auto.delSpiltterTrenner(element);
            auto.showSplitter();
        }
        if(grp == "SplitterStart") {
            auto.delStarter(element);
            auto.showSplitter();
        }
        if(grp == "SplitterEnd") {
            auto.delEnder(element);
            auto.showSplitter();
        }
        auto.teileAlle();
    }
}

function addNewNaehrwert(){
    let typ = document.getElementById('new_type');
    if(typ.selectedIndex == 0){
        alert("Bitte Nährwerttype auswählen");
        typ.focus();
        return
    }
    let typText = typ.options[typ.selectedIndex].text;

    let val = document.getElementById('new_val').value;
    if(val == "0.00" || val == ""){
        alert("Bitte Wert auswählen");
        document.getElementById('new_val').focus();
        return
    }

    let ca  = document.getElementById('new_precision');
    if(ca.selectedIndex == 0){
        alert("Bitte Genauigkeit auswählen");
        ca.focus();
        return
    }
    let caText = ca.options[ca.selectedIndex].text;

    let unit = document.getElementById('new_unit');
    if(unit.selectedIndex == 0){
        alert("Bitte Einheit auswählen");
        unit.focus();
        return
    }
    let unitText = unit.options[unit.selectedIndex].text;

    document.getElementById("naehrwertedb").value += typText+"#;#"+unitText+"#;#"+val+"#;#"+caText+"#;#"+typ.value+"#;#"+unit.value+"#;#"+ca.value+"##;;##";
    naehr.addFromDb();
    naehr.showAlle();
}
function str_replace(search,replace,subject){
    return subject.split(search).join(replace);
    }


function delNaehrwert(id){
    naehr.delItem(id);
    naehr.addFromDb();
    naehr.showAlle();
}
let contextMenuID = "";
document.addEventListener('DOMContentLoaded', function(){
    
    naehr = new NahrwertTabelle();
    naehr.addNahrwertReihelfolge();
    naehr.addFromDb();
    naehr.showAlle();

    //Global auto;
    let oritxt = document.getElementById("oriText").innerHTML;
    auto = new AutoText(oritxt);
    auto.addIgnoreAllwaysFromDB();
    auto.addAutoEditsFromDB();

    //start spillter
    auto.addSpiltterTrenner(";");
    auto.addSpiltterTrenner(",");
    auto.addSpiltterTrenner(":");
    auto.addSpiltterTrenner(".");
    auto.addSpiltterTrenner("(");
    auto.addSpiltterTrenner(")");
    auto.addSpiltterTrenner("[");
    auto.addSpiltterTrenner("]");
    auto.addSpiltterTrenner("/");
    auto.addSpiltterTrenner("{");
    auto.addSpiltterTrenner("}");

    auto.addStarter(":");
    auto.addStarter("(");
    auto.addStarter("[");
    auto.addStarter("{");

    auto.addEnder(".");
    auto.addEnder(")");
    auto.addEnder("]");
    auto.addEnder("}");

    // db daten hier
    auto.loadErgFromDB(document.getElementById("ProductIngredientsDB").innerHTML);
    auto.loadAllIngredienzDB(document.getElementById("allIngredienzNames").innerHTML);


    // add allergene
    auto.loadAllergeneFromDB(document.getElementById("allergene_db").innerHTML);

    auto.addIgnoreOneTimeIngredienz(" ");
//        auto.addIgnore("**");

    auto.showSplitter();
    //start first teile
    auto.teileAlle();

}, false);

function ignorenow(){
    auto.addIgnoreOneTimeIngredienz(contextMenuID);
    auto.showErgebnisse();
}
function ignoreallways(){
    auto.addIgnoreAllwaysIngredienz(contextMenuID);
    auto.showErgebnisse();
    addToSaveElement(contextMenuID,"ignoreallways",'tosaveindb_IgnoreAllways');
}
function contextaddnow(){
    auto.addIngredienzNow(contextMenuID);
    auto.showErgebnisse();
}

function contexteditchange(){
    let sTo = document.getElementById("editIngredienz").value;
    let sFrom = contextMenuID;
    let sAlle = document.getElementById("allAutoEdit").value;
    if(sAlle.indexOf("-#-"+sTo) > -1){
        if (!confirm("Die Text '"+sTo+"' wir bereits als Ausnahme behadelt! Wollen Sie trozdem eine neue Regel erstellen ?"))
            return;
    }
    if(sAlle.indexOf(sFrom+"-#-") > -1){
        if (!confirm("Die Text '"+sFrom+"' wir bereits als Ausnahme behadelt! Wollen Sie trozdem eine neue Regel erstellen ?"))
            return;
    }

    hideshow('editIngredienzDiv');
    hideshow('ausgabeNew');
    auto.addIgnoreAutoEdit(sFrom,sTo);
    auto.showErgebnisse();
    addToSaveElement(contextMenuID,document.getElementById("editIngredienz").value,'tosaveindb_allAutoEdit')
}
function contextedit(){
    let con = "<table><tr><td>Text:</td><td> <d  style='font-size: larger;background:#55ff42;'>"+contextMenuID+"</d></td></tr>";
    con += "<tr><td>ändern zu:</td><td><input type='text' id='editIngredienz'  value='"+contextMenuID+"'></td></tr></table>"

    document.getElementById("editIngredienzDiv").innerHTML = con;

    setTimeout(function(){
        $( "#editIngredienz" ).select();
    }, 400);
}

// Nur für IE 5+ und NN 6+
ie5=(document.getElementById && document.all && document.styleSheets)?1:0;
nn6=(document.getElementById && !document.all)?1:0;

// Kontextmenü initialisieren
if (ie5 || nn6) {
    menuWidth=220, menuHeight=200;
    menuStatus=0;
    document.write(
        "<div id='menu' style='top:-250px;box-shadow: 5px 5px 5px #5286ff;padding: 7px;border:1px solid #abc;border-radius: 3px;background: #fff;position:absolute;left:0;z-index:1111'>"
        +"<table id='contextMenu1' width='"+menuWidth+"' height='"+menuHeight+"'>"
        +"<tr><td><u style='font-weight:bold;font-size: larger;' id='contextMenu1Header'>Zutat: 'test'</u></td></tr>"
        + "<tr><td><a style='width:100%;' class='btn btn-alt-primary' onclick=ignorenow()>Ignorieren für dieses Produkt</a></td></tr>"
        + "<tr><td><a style='width:100%;' class='btn btn-alt-primary' onclick=ignoreallways()>Ignorieren für immer</a></td></tr>"
        + "<tr><td><a style='width:100%;' class='btn btn-alt-primary' onclick=contextaddnow()>Hinzufügen</a></td></tr>"
        + "<tr><td><a style='width:100%;' class='btn btn-alt-primary' id='btn_rename' data-toggle='modal' data-target='#myModal' onclick=contextedit()>Bearbeiten/Ändern</a></td></tr>"
        +"</table>"
        +"</div>");

        //<button type="button" class="btn btn-alt-primary" id="btn_rename" data-toggle="modal" data-target="#myModal">Umbennen</button>
    // Rechter Mausklick: Menü anzeigen, linker Mausklick: Menü verstecken
    document.oncontextmenu=showMenu; //oncontextmenu geht nicht bei NN 6.01
    document.onmouseup=hideMenu;
}

function hideshow(id) {
    var x = document.getElementById(id);
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
}

// Kontextmenü anzeigen
function showMenu(e) {
    if(e.target.id != "ingredienzmenu")
        return true;

    contextMenuID = e.target.innerText;
    document.getElementById('contextMenu1Header').innerHTML = "Zutat: " + contextMenuID;

    if(e.pageX>menuWidth+window.pageXOffset) xPos=e.pageX-menuWidth;
    else xPos=e.pageX;
    if(e.pageY>menuHeight+window.pageYOffset) yPos=e.pageY-menuHeight;
    else yPos=e.pageY;

    $("#menu").css({top: yPos, left: xPos, position:'absolute'});

    menuStatus=1;
    return false;
}

// Kontextmenü verstecken
function hideMenu(e) {
    $("#menu").css({top: -250, left: -250, position:'absolute'});
    if (menuStatus==1 && ((ie5 && event.button==1) || (nn6 && e.which==1))) {
        setTimeout("document.getElementById('menu').style.top=-250px",250);
        menuStatus=0;
    }
}

// Quelltext anzeigen
function viewSource() {
    let w=window.open("view-source:"+window.location,'','resizable=1,scrollbars=1');
}

// Seite in neuem Fenster öffnen
function openFrameInNewWindow() {
    let w=window.open(window.location,'','resizable=1,scrollbars=1,status=1');
}

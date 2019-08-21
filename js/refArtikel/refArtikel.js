var refArtikel = new DaftarObj2({
  prefix: "refArtikel",
  url: "pages.php?Pg=refArtikel",
  formName: "refArtikelForm",
  refArtikel_form: "0", //default js refArtikel
  loading: function() {
    //alert('loading');
    this.topBarRender();
    this.filterRender();
    this.daftarRender();
    this.sumHalRender();
  },

  detail: function() {
    //alert('detail');
    var me = this;
    errmsg = this.CekCheckbox();
    if (errmsg == "") {
      var box = this.GetCbxChecked();
      //UserAktivitasDet.genDetail();
    } else {
      alert(errmsg);
    }
  },
  daftarRender: function() {
    var me = this; //render daftar
    addCoverPage2("daftar_cover", 1, true, true, {
      renderTo: this.prefix + "_cont_daftar",
      imgsrc: "images/wait.gif",
      style: { position: "absolute", top: "5", left: "5" }
    });
    $.ajax({
      url: this.url + "&tipe=daftar",
      type: "POST",
      data: $("#" + this.formName).serialize(),
      success: function(data) {
        var resp = eval("(" + data + ")");
        document.getElementById(me.prefix + "_cont_daftar").innerHTML =
          resp.content;
        $("#collapseOne").attr("class", "collapse");
        me.sumHalRender();
        me.setTableHeader();
      }
    });
  },
  Baru: function() {
    var me = this;
    var err = "";

    if (err == "") {
      var cover = this.prefix + "_formcover";
      document.body.style.overflow = "hidden";
      if (me.refArtikel_form == 0) {
        //baru dari refArtikel
        addCoverPage2(cover, 999, true, false);
      } else {
        //baru dari barang
        addCoverPage2(cover, 999, true, false);
      }
      $.ajax({
        type: "POST",
        data: $("#" + this.formName).serialize(),
        url: this.url + "&tipe=Baru",
        success: function(data) {
          var resp = eval("(" + data + ")");
          document.getElementById(cover).innerHTML = resp.content;
          textboxio.replaceAll('#isiArtikel', {
            paste: {
              style: 'clean'
            },
            css: {
              stylesheets: ['js/textboxio/example.css']
            }
          });
          $("#tanggalArtikel").datepicker({
            dateFormat: "dd-mm-yy",
            showAnim: "slideDown",
            inline: true,
            showOn: "button",
            buttonImage: "datepicker/calender1.png",
            buttonImageOnly: true,
            buttonText: ""
          });
          me.AfterFormBaru();
        }
      });
    } else {
      alert(err);
    }
  },
  Edit: function() {
    var me = this;
    errmsg = this.CekCheckbox();
    if (errmsg == "") {
      var box = this.GetCbxChecked();

      var cover = this.prefix + "_formcover";
      addCoverPage2(cover, 999, true, false);
      document.body.style.overflow = "hidden";
      $.ajax({
        type: "POST",
        data: $("#" + this.formName).serialize(),
        url: this.url + "&tipe=Edit",
        success: function(data) {
          var resp = eval("(" + data + ")");
          if (resp.err == "") {
            document.getElementById(cover).innerHTML = resp.content;
            textboxio.replaceAll('#isiArtikel', {
              paste: {
                style: 'clean'
              },
              css: {
                stylesheets: ['js/textboxio/example.css']
              }
            });
            $("#tanggalArtikel").datepicker({
              dateFormat: "dd-mm-yy",
              showAnim: "slideDown",
              inline: true,
              showOn: "button",
              buttonImage: "datepicker/calender1.png",
              buttonImageOnly: true,
              buttonText: ""
            });
            me.AfterFormEdit(resp);
          } else {
            alert(resp.err);
            delElem(cover);
            document.body.style.overflow = "auto";
          }
        }
      });
    } else {
      alert(errmsg);
    }
  },
  saveNew: function() {
    var me = this;
    this.OnErrorClose = false;
    document.body.style.overflow = "hidden";
    var cover = this.prefix + "_formsimpan";
    addCoverPage2(cover, 999999, true, false);
    $.ajax({
      type: "POST",
      // data: $("#" + this.prefix + "_form").serialize(),
      data: {
        judulArtikel : $("#judulArtikel").val(),
        isiArtikel : me.getEditorContent(),
        tanggalArtikel : $("#tanggalArtikel").val(),
        statusArtikel : $("#statusArtikel").val(),
      },
      url: this.url + "&tipe=saveNew",
      success: function(data) {
        var resp = eval("(" + data + ")");
        delElem(cover);
        if (resp.err == "") {
          me.Close();
          me.refreshList();
        } else {
          alert(resp.err);
        }
      }
    });
  },
  saveEdit: function(idEdit) {
    var me = this;
    this.OnErrorClose = false;
    document.body.style.overflow = "hidden";
    var cover = this.prefix + "_formsimpan";
    addCoverPage2(cover, 999999, true, false);
    $.ajax({
      type: "POST",
      // data: $("#" + this.prefix + "_form").serialize()+"&idEdit="+idEdit,
      data: {
        judulArtikel : $("#judulArtikel").val(),
        isiArtikel : me.getEditorContent(),
        tanggalArtikel : $("#tanggalArtikel").val(),
        statusArtikel : $("#statusArtikel").val(),
        idEdit : idEdit,
      },
      url: this.url + "&tipe=saveEdit",
      success: function(data) {
        var resp = eval("(" + data + ")");
        delElem(cover);
        if (resp.err == "") {
          me.Close();
          me.refreshList();
        } else {
          alert(resp.err);
        }
      }
    });
  },
   getEditorContent: function(){
     var editors = textboxio.get('#isiArtikel');
     var editor = editors[0];
     return editor.content.get();
 }

});

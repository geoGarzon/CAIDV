window.onload = function(){
	var cajas = {
		inputs: document.getElementsByTagName("input"),
		selects: document.getElementsByTagName("select"),
		textareas: document.getElementsByTagName("textarea"),
		init: function(){
			for(tags in this){
				set_Attributes(this[tags]);
			}
		}
	};
	cajas.init();
	var envia_frm = document.getElementById("envia_frm");
	if(envia_frm != null){
		envia_frm.onclick=function(){
			enviar(cajas);
		}
		envia_frm.type="button";
		envia_frm.title="HAGA CLICK PARA GUARDAR EL FORMULARIO";
	}
	//VARIABLE PARA LOS ID
	var f=0;
	var msj_obligatorio = document.getElementById("msj_obligatorio");
	if(msj_obligatorio != null){
		msj_obligatorio.innerHTML="<center><strong><font size='4' color='#951818'>TODOS LOS CAMPOS CON * O DE BORDE EN ROJO SON OBLIGATORIOS</font></strong></center";
	}
}
function set_Attributes(tag){
	var totalTags = tag.length;
	for(a=0;a<totalTags;a++){
		if(tag[a].getAttribute("forzar")){
			var validadores = new Array();
			validadores[a] = tag[a].getAttribute("forzar").split(",");
			totalValidadores = validadores[a].length;
			for(b=0;b<totalValidadores;b++){
				switch(validadores[a][b]){
					case 'obligatorio':
						document.getElementById(tag[a].id).parentNode.innerHTML+="<font color='red' size='4'>*</font>";
					break;
					case 'obligatorio2':
						document.getElementById(tag[a].id).onblur=function(){
							if(this.value=="" || this.value==" " || this.value=="  "){
								this.style.borderColor="#a94442";	
							}else{
								this.style.borderColor="#66afe9";
							}
						}
					break;
					case 'cedula':
						document.getElementById(tag[a].id).onkeypress=function(event){
                        	return isRif(event,this.value);
                    	}
					break;
					case 'numeros':
						document.getElementById(tag[a].id).onkeypress=function(event){
                        	return soloNumeros(event);
                    	}
					break;
					case 'letras':
						document.getElementById(tag[a].id).onkeypress=function(event){
							 return soloLetras(event);
						}
					break;
					case 'correo':
						document.getElementById(tag[a].id).onblur=function(){
							validarCorreo(this.value);
							if(this.value=="" || this.value==" " || this.value=="  "){
								this.style.borderColor="#a94442";	
							}else{
								this.style.borderColor="#66afe9";
							}
							
							
						}
					break;
					case 'parroquia':
						document.getElementById(tag[a].id).onkeyup=function(){
							buscarParroquia(this);
						}
					break;
				}
			}
		}
	}
}
function enviar(cajas){
	//VARIABLE PARA VALIDAR QUE LOS CAMPOS NO ESTAN VACIOS
	var send=true;
	for(obj in cajas){
		var arr = cajas[obj].length;
		for(c=0;c<arr;c++){
			if(cajas[obj][c].disabled!=true){
				if(cajas[obj][c].getAttribute("forzar")){
					var validar = new Array();
					validar[c] = cajas[obj][c].getAttribute("forzar").split(",");
					total_validar = validar[c].length;
					for(d=0;d<total_validar;d++){
						if(validar[c][d]=="obligatorio"){
							if(document.getElementById(cajas[obj][c].id).value=="" || document.getElementById(cajas[obj][c].id).value==" " || document.getElementById(cajas[obj][c].id).value=="  ")
								send=false;
						}else if(validar[c][d]=="obligatorio2"){
							if(document.getElementById(cajas[obj][c].id).value=="" || document.getElementById(cajas[obj][c].id).value==" " || document.getElementById(cajas[obj][c].id).value=="  ")
								send=false;
						}else if(validar[c][d]=="correo"){
							if(document.getElementById(cajas[obj][c].id).value!="")
								if(!validarCorreo(document.getElementById(cajas[obj][c].id).value))
									send=false;
						}
					}
				}
			}
		}
	}
	if(send){
		console.log("FORMULARIO ENVIADO");
		document.getElementById("frm").submit();
	}else{
		console.log("FORMULARIO NO ENVIADO");
		alert("EXISTEN CAMPOS VACIOS EN EL FORMULARIO");
	}
}
//AJAX PARA PARROQUIA
var divAjax;
divAjax = document.createElement("div");
divAjax.className="ajax";
function buscarParroquia(el){
	var datosAjax="";
	valor = el.value;
	id = el.id;
	td = el.parentNode;
	td.style.position="relative";
	td.appendChild(divAjax);
	if(valor!=""){
		$.post("http://localhost/frontcontroller/index.php/parroquia/busqueda_ajax",{envio:"ajax",evento:"buscarParroquia",value:valor},function(data){
			console.log(data);
			datos = JSON.parse(data);
			for(var datum in datos){
				var miobjeto = datos[datum];
				miobjeto2= JSON.stringify(miobjeto);
				datosAjax +='<a href="javascript:void(0)" onclick=\'mostrarDatosParroquia('+miobjeto2+')\'>'+miobjeto.nombre_p+' - '+miobjeto.nombre_m+' - '+ miobjeto.nombre_e +' -'+ miobjeto.nombre_pais +' </a><br>';
			} 
			divAjax.style.display="block";
			divAjax.innerHTML=datosAjax;
		});
	}else{
		document.getElementById("idParroquia").value="";
		document.getElementById("parroquia").value="";
		divAjax.style.display="none";
		divAjax.innerHTML="";
	}
}
function mostrarDatosParroquia(objeto){
	document.getElementById("idParroquia").value=objeto.idParroquia;
	document.getElementById("parroquia").value=objeto.nombre_p+" - "+objeto.nombre_m+" - "+objeto.nombre_e+" - "+objeto.nombre_pais;
	divAjax.style.display="none";
	divAjax.innerHTML="";
}
/* CREADOR DE TABLA MUCHOS
document.getElementById("envia_frm").onclick = function()
{
	var cosas = document.getElementById("cosas");
	var cosas_value = document.getElementById("cosas").value;
	var cosas_option = cosas.options[cosas.selectedIndex].text;

	var idTabla = "tbody_actual";
	var campos = {
		//ETIQUETAS		
		tag : ["input","input","select","input"],
		//NOMBRES DE LAS ETIQUETAS
		name : ["producto[]","cantidad[]","select[]","otro[]"],
		//ID DE LAS ETIQUETAS (FINALIZAR CON - PARA HACER NUMERACION)
		id : ["producto-","cantidad-","selectpicker","otro-"],
		//TIPOS DE LA ETIQUETAS (DEJAS VACIO PARA SELECT)
		type : ["text","number","","text"],
		//VALORES PARA LAS ETIQUETAS
		value : [cosas_option,"",[["1","ACTIVO"],["0","INACTIVO"]],""],
		//CLASES PARA LAS ETIQUETAS
		clases: ["form-control","form-control","form-control","form-control"],
		//VALIDACIONES DE LA LIBRERIA PARA LAS ETIQUETAS
		libAA: ["",["forzar","obligatorio","numeros"],"",""],
		//ATRIBUTOS PARA LAS ETIQUETAS
		attributes: [["readonly","true"],["readonly","true"],"",["readonly","true"]]
	};
	var boton_eliminar={
		clases: "btn btn-primary"
	}
	muchos(idTabla,campos,boton_eliminar);
};
*/

/************************************************/
//             FUNCION MUCHOS 
/************************************************/
var f=0;
var arr_elementos= new Array();
function muchos(idTabla,campos,boton_eliminar){
	var tag_len = campos.tag.length;
	for(e=0;e<tag_len;e++){
		for(campo in campos){
			switch(campo){
				case 'tag':
					var elemento_creado = document.createElement(campos[campo][e]);
				break;
				case 'name':
					elemento_creado.name = campos[campo][e];
				break;
				case 'id':
					if(campos[campo][e]!="selectpicker"){
						elemento_creado.id = campos[campo][e]+f;	
					}
				break;
				case 'type':
					if(elemento_creado.tagName!="SELECT"){
						elemento_creado.type = campos[campo][e];
					}
				break;
				case 'value':
					if(campos[campo][e]!="" && elemento_creado.tagName!="SELECT"){
						elemento_creado.value = campos[campo][e];
					}else if(campos[campo][e]!=""){
						var opciones_len = campos[campo][e].length;
						for(g=0;g<opciones_len;g++){
							var option = document.createElement("option");
							option.value=campos[campo][e][g][0];
							option.text=campos[campo][e][g][1];
							elemento_creado.add(option);
						}
					}
				break;
				case 'clases':
					elemento_creado.className=campos[campo][e];
				break;
				case 'libAA':
					if(campos[campo][e]!=""){
						var atributos_len = campos[campo][e].length;
						var parametros="";
						for(h=1;h<atributos_len;h++){
							if(h<atributos_len-1){
								parametros += campos[campo][e][h]+",";
							}else{
								parametros += campos[campo][e][h];
							}
						}
						elemento_creado.setAttribute(campos[campo][e][0],parametros);	
					}
				break;
				case 'attributes':
					if(campos[campo][e]!=""){
						var campos_longitud_atributos = campos[campo][e].length;
						console.log(campos[campo][e]);
						for(l=0;l<campos_longitud_atributos;l++){
							elemento_creado.setAttribute(campos[campo][e][l],campos[campo][e][l+1]);		
							l++;
							console.log(l);
						}
						
					}
				break;
			}
			arr_elementos[e]=elemento_creado;
		}
	}
	f++;
	var tr = document.createElement("tr");
	for(i=0;i<=tag_len;i++){
		var td = document.createElement("td");
		if(i<tag_len){
			if(arr_elementos[i].type!="hidden"){
				td.appendChild(arr_elementos[i]);
				tr.appendChild(td);
			}else{
				tr.appendChild(arr_elementos[i]);
			}
		}else{
			var elimina_fila = document.createElement("button");
			elimina_fila.type='button';
			elimina_fila.innerHTML=boton_eliminar.texto;
			elimina_fila.className = boton_eliminar.clases;
			elimina_fila.onclick=function(){
				eliminar_fila(this,idTabla);
			}
			td.appendChild(elimina_fila);
			tr.appendChild(td);	
		}
	}
	document.getElementById(idTabla).appendChild(tr);
}
function eliminar_fila(_this,idTabla){
	document.getElementById(idTabla).removeChild(_this.parentNode.parentNode);
}
/************************************************/
//            FIN FUNCION MUCHOS 
/************************************************/
/************************************************/
//			CLASE para la paginacion
//				COMO USARLA
//<div class="paginador">
//    <div class="head-paginador">
//        <div class='col-md-3'>
//            <label>
//           REGISTROS POR PAGINA
//           <select id='limit_paginador' class='form-control'>
//                <option value='5'>5</option>
//                <option value='10'>10</option>
//                <option value='20'>20</option>
//                <option value='50'>50</option>
//                <option value='100'>100</option>
//            </select>
//            </label>
//        </div>
//        <div class='col-md-2 col-md-offset-7'>
//            <label>
//            BUSCAR: <input type='text' id='like_paginador' class='form-control'>
//            </label>
//       </div>
//    </div>
//    <table id='tabla_paginador' class='table table-striped table-bordered table-hover'>
//        <thead>
//            <th>
//                ID
//            </th>
//            <th>
//                NOMBRE DEL ICONO
//            </th>
//            <th>
//                ICONO
//            </th>
//            <?php
//            //PONE LOS TITULOS ESTADO, EDITAR, CONSULTAR
//            $html->titulos();
//            ?>
//        </thead>
//        <tbody id='tbody_paginador'>
//        </tbody>
//        <tfoot>
//            <?php
//            //PONE LOS TITULOS ESTADO, EDITAR, CONSULTAR
//            $html->titulos();
//            ?>
//        </tfoot>
//    </table>
//    <div class="foot-paginador">
//        <div class='leyenda' id='leyenda_paginador'>
//        </div>
//        <div class='col-md-2 col-md-offset-9'>
//            <button id='atras_paginador' class='btn btn-default' type='button'><</button>
//            <button id='adelante_paginador'class='btn btn-default'  type='button'>></button>
//        </div>
//    </div>
//</div>
//<script>
//	var ClassPaginador = new ClassPaginador();
//	ClassPaginador.init();
//	ClassPaginador.url = "<?=INDEX.CONTROLLER?>/listar";
//	ClassPaginador.posicion_icono=1;
//</script>
/************************************************/
function ClassPaginador(){
    //ELEMENTOS
    this.tabla=document.getElementById("tabla_paginador");
    this.tbody=document.getElementById("tbody_paginador");
    this.leyenda=document.getElementById("leyenda_paginador");
    //VARIABLES
    this.pagina=0;
    this.like="";
    this.order="";
    this.limit=document.getElementById("limit_paginador").value;
    //POSICION_ICONO DETERMINA SI SE PONDRA ICONO EN LA TABLA Y SU POSICION
    this.posicion_icono=null;
    this.url="";
    this.total_registros=0;
    //VARIABLE PARA ACCEDER A METODOS PRIVADOS
    var _this = this;
    this.init = function(){
        document.getElementById("like_paginador").onkeyup=function(){
            _this.like=this.value;
            buscar();
        }
        document.getElementById("limit_paginador").onchange=function(){
            _this.limit = this.value;
            limitar();
        }
        document.getElementById("adelante_paginador").onclick=function(){
            adelante();
        }
        document.getElementById("atras_paginador").onclick=function(){
            atras();
        }
        var thead = _this.tabla.tHead;
        var th = thead.getElementsByTagName("th");
        var th_length = th.length;
        var footer="";
        for(i=0;i<th_length;i++){
            th[i].innerHTML="<button type='button' name='order_paginador' value='"+(Number(i)+1)+"' title='ORDENAR POR "+th[i].innerHTML.trim()+"' style='border:none;background:none;'>"+th[i].innerHTML.trim()+"</button>";
            footer+="<th><button type='button' name='order_paginador' value='"+(Number(i)+1)+"' title='ORDENAR POR "+th[i].innerHTML.trim()+"' style='border:none;background:none;'>"+th[i].innerHTML.trim()+"</button></th>";
        }
        
        _this.tabla.tFoot.innerHTML=footer;

        var order_paginador = document.getElementsByName("order_paginador");
        var order_length = document.getElementsByName("order_paginador").length;
        for(b=0;b<order_length;b++){
            order_paginador[b].onclick=function(){
                order(this.value);
            }
        }        
    }
   	this.listar = function(){
    	ajax_paginador(_this.url,{evento:"ajax",limit:_this.limit});        
    }
    function buscar(){
        _this.pagina=0;
        ajax_paginador(_this.url,{evento:"ajax",pagina:_this.pagina,like:_this.like/*,limit:limit*/});
    }
    function limitar(value){
        ajax_paginador(_this.url,{evento:"ajax",limit:_this.limit});
    }
    function adelante(){
        _this.like = document.getElementById("like_paginador").value;
        _this.limit = document.getElementById("limit_paginador").value;
        _this.total_registros = document.getElementById("total_registros").value;
        if( _this.pagina<_this.total_registros && (Number(_this.pagina)+Number(_this.limit))<=_this.total_registros ){
            _this.pagina+= Number(_this.limit);
        }
        ajax_paginador(_this.url,{evento:"ajax",pagina:_this.pagina,like:_this.like,limit:_this.limit});        
    }
    function atras(){
        _this.like = document.getElementById("like_paginador").value;
        _this.limit = document.getElementById("limit_paginador").value;
        if( _this.pagina>0){
            _this.pagina-= Number(_this.limit);
        }
        ajax_paginador(_this.url,{evento:"ajax",pagina:_this.pagina,like:_this.like,limit:_this.limit});        
    }
    function order(value){
        _this.order = (_this.order!=value+" DESC")? value+" DESC" : value+" ASC";
        ajax_paginador(_this.url,{evento:"ajax",pagina:_this.pagina,like:_this.like,order:_this.order,limit:_this.limit});        
    }
    function ajax_paginador(url,parametros){
        window.XMLHttpRequest || (window.XMLHttpRequest = function() { return new ActiveXObject("Msxml2.XMLHTTP") || new ActiveXObject("Microsoft.XMLHTTP"); });
        var ajax = new XMLHttpRequest();
        ajax.open("POST",_this.url,true);
        ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
        var datos="";
        for(parametro in parametros){
            datos+="&"+parametro+"="+parametros[parametro];
        }
        ajax.send(datos);
        ajax.onreadystatechange=function(){
            if (ajax.readyState==4) {
            	console.log(ajax.responseText);
                var respuesta = JSON.parse(ajax.responseText);
                
                var cadena="";
                for (objeto in respuesta){
                    cadena+="<tr>";
                    //console.log(respuesta[objeto]);
                    if(objeto!="total" && objeto!="boton"){
                        var a = 0;
                        for(val in respuesta[objeto]){ 
                            if(a ==_this.posicion_icono){
                                //cadena+="<td>"+respuesta[objeto][val]+"</td>";
                                cadena+="<td><span class='glyphicon glyphicon-"+respuesta[objeto][val]+"'></span></td>";        
                                //console.log(respuesta[objeto][val]);
                            }else{
                            	//console.log(typeof respuesta[objeto][val]);
                            	if(typeof respuesta[objeto][val] == "string"){
                                	cadena+="<td>"+respuesta[objeto][val]+"</td>";
                            	}else{
                            		for(pos in respuesta[objeto][val]){
                            			cadena+="<td>"+respuesta[objeto][val][pos]+"</td>";
                            		}
                                	
                            	
                            	
                                console.log(respuesta[objeto][val]);
                            	}

                            }
                            a++;
                        }
                    }else if(objeto=="total"){
                        _this.leyenda.innerHTML=respuesta[objeto]+" REGISTROS <input type='hidden' value='"+respuesta[objeto]+"' id='total_registros'>";
                    }else if(objeto=="boton"){
                        console.log(respuesta[objeto]);
                    }   
                    cadena+="</tr>"
                }
                _this.tbody.innerHTML=cadena;
            }
        }
    }
}
/************************************************/
//			FIN CLASE PAGINACION
/************************************************/

//window.XMLHttpRequest || (window.XMLHttpRequest = function() { return new ActiveXObject("Msxml2.XMLHTTP") || new ActiveXObject("Microsoft.XMLHTTP"); });

/************************************************/
//               FUNCION AJAXFUN
/************************************************/
/* var valores = ajaxfun("<?=INDEX?>icono/listar",{valores de pos}); */

/*function ajaxfun(url,parametros){
    ajax = new XMLHttpRequest();
    ajax.open("POST", url, true);
    ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    ////
    var datos="";
    for(parametro in parametros){
        datos+="&"+parametro+"="+parametros[parametro];
    }
    ////
    ajax.send(datos);
    ajax.onreadystatechange=function(){
        if (ajax.readyState==4) {
            var respuesta = JSON.parse(ajax.responseText);
            return respuesta;
        }
    }
}*/
/************************************************/
//				FIN FUNCION AJAXFUN
/************************************************/


///// 		
function soloLetras(e){
    key = e.keyCode || e.which;
    tecla = String.fromCharCode(key).toLowerCase();
    letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
    especiales = [8,35,36,37,46,39,9];
    tecla_especial = false
    for(var i in especiales){
        if(key == especiales[i]){
            tecla_especial = true;
            break;
        }
    }
	if(letras.indexOf(tecla)==-1 && !tecla_especial){
	    return false;
    }
}
function soloNumeros(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode
	if (charCode > 31 && (charCode < 48 || charCode > 57) && charCode != 46)
    	return false;
    return true;
}
function validarCorreo(valor){
	var expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
   	if (!expr.test(valor)){
       	alert("Error: La dirección de correo es incorrecta.");
       	return false;
   	}else{
   		return true;
   	}
}
function isRif(evt,object){
    var charCode = (evt.which) ? evt.which : event.keyCode
    if(object.length<1){
        if (charCode != 101 && charCode != 103 && charCode != 106 && charCode != 118)
            return false;
        return true;
    }else{
        if (charCode > 31 && (charCode < 48 || charCode > 57) && charCode != 46)
            return false;
        return true;
    }
}
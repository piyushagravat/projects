function selectSubcategories(subcat_id){
	if(subcat_id!="-1"){
		loadData('state',subcat_id,"Sub Categories");
		$("#city_dropdown").html("<option value='-1'>Select Sub-Sub-Categories</option>");	
	}else{
		$("#state_dropdown").html("<option value='-1'>Select Sub-Categories</option>");
		$("#city_dropdown").html("<option value='-1'>Select Sub-Sub-Categories</option>");		
	}
}

function selectSubsubcategories(sscat_id){
	if(sscat_id!="-1"){
		loadData('city',sscat_id,"Sub Sub Categories");
	}else{
		$("#city_dropdown").html("<option value='-1'>Select Sub-Sub-Categories</option>");		
	}
}

function selectSubcategoriesEdit(subcat_id){
	if(subcat_id!="-1"){
		loadDataEdit('state',subcat_id,"Sub Categories");
		$("#city_dropdown").html("<option value='-1'>Select Sub-Sub-Categories</option>");	
	}else{
		$("#state_dropdown").html("<option value='-1'>Select Sub-Categories</option>");
		$("#city_dropdown").html("<option value='-1'>Select Sub-Sub-Categories</option>");		
	}
}

function selectSubsubcategoriesEdit(sscat_id){
	if(sscat_id!="-1"){
		loadDataEdit('city',sscat_id,"Sub Sub Categories");
	}else{
		$("#city_dropdown").html("<option value='-1'>Select Sub-Sub-Categories</option>");		
	}
}

function loadDataEdit(loadType,loadId,showstr){
	var dataString = 'loadType='+ loadType +'&loadId='+ loadId;
	$("#"+loadType+"_loader").show();
    $("#"+loadType+"_loader").fadeIn(400).html('Please wait... <img src="http://headwaytechnologies.in/images/loading.gif" />');
	$.ajax({
		type: "POST",
		url: "../loadData",
		data: dataString,
		cache: false,
		success: function(result){
			$("#"+loadType+"_loader").hide();
			$("#"+loadType+"_dropdown").html("<option value='-1'>Select "+showstr+"</option>");  
			$("#"+loadType+"_dropdown").append(result);  
		}
	});
}


function loadData(loadType,loadId,showstr){
	var dataString = 'loadType='+ loadType +'&loadId='+ loadId;
	$("#"+loadType+"_loader").show();
    $("#"+loadType+"_loader").fadeIn(400).html('Please wait... <img src="http://headwaytechnologies.in/images/loading.gif" />');
	$.ajax({
		type: "POST",
		url: "loadData",
		data: dataString,
		cache: false,
		success: function(result){
			$("#"+loadType+"_loader").hide();
			$("#"+loadType+"_dropdown").html("<option value='-1'>Select "+showstr+"</option>");  
			$("#"+loadType+"_dropdown").append(result);  
		}
	});
}


function selectBrand(mid){
	if(mid!="-1"){
		loadBrand('brand',mid,"Brand");
		$("#brand_dropdown").html("<option value='-1'>Select Sub-Sub-Categories</option>");	
	}else{
		$("#brand_dropdown").html("<option value='-1'>Select Sub-Categories</option>");
		$("#brand_dropdown").html("<option value='-1'>Select Sub-Sub-Categories</option>");		
	}
}
function loadBrand(loadType,loadId,showstr){
	var dataString = 'loadType='+ loadType +'&loadId='+ loadId;
	$("#"+loadType+"_loader").show();
    $("#"+loadType+"_loader").fadeIn(400).html('Please wait... <img src="http://headwaytechnologies.in/images/loading.gif" />');
	$.ajax({
		type: "POST",
		url: "loadBrand",
		data: dataString,
		cache: false,
		success: function(result){
			$("#"+loadType+"_loader").hide();
			$("#"+loadType+"_dropdown").html("<option value='-1'>Select "+showstr+"</option>");  
			$("#"+loadType+"_dropdown").append(result);  
		}
	});
}

function selectBrandFromEdit(mid){
	if(mid!="-1"){
		loadBrandFromEdit('brand',mid,"Brand");
		$("#city_dropdown").html("<option value='-1'>Select Sub-Sub-Categories</option>");	
	}else{
		$("#brand_dropdown").html("<option value='-1'>Select Sub-Categories</option>");
		$("#city_dropdown").html("<option value='-1'>Select Sub-Sub-Categories</option>");		
	}
}
function loadBrandFromEdit(loadType,loadId,showstr){
	var dataString = 'loadType='+ loadType +'&loadId='+ loadId;
	$("#"+loadType+"_loader").show();
    $("#"+loadType+"_loader").fadeIn(400).html('Please wait... <img src="http://headwaytechnologies.in/images/loading.gif" />');
	$.ajax({
		type: "POST",
		url: "http://headwaytechnologies.in/product/loadBrandFromEdit",
		data: dataString,
		cache: false,
		success: function(result){
			$("#"+loadType+"_loader").hide();
			$("#"+loadType+"_dropdown").html("<option value='-1'>Select "+showstr+"</option>");  
			$("#"+loadType+"_dropdown").append(result);  
		}
	});
}
function selectSubcategoriesEditPro(subcat_id){	
	if(subcat_id!="-1"){	
	loadDataEditPro('subcat',subcat_id,"Sub Categories");	
	$("#subsubcat_dropdown").html("<option value='-1'>Select Sub-Sub-Categories</option>");	
	}else{		
	$("#subcat_dropdown").html("<option value='-1'>Select Sub-Categories</option>");	
	$("#subsubcat_dropdown").html("<option value='-1'>Select Sub-Sub-Categories</option>");			
	}}
	
function selectSubsubcategoriesEditPro(sscat_id)
{	
	if(sscat_id!="-1"){		
	loadDataEditPro('subsubcat',sscat_id,"Sub Sub Categories");	
	}else{	
	$("#subsubcat_dropdown").html("<option value='-1'>Select Sub-Sub-Categories</option>");			
}}
function loadDataEditPro(loadType,loadId){
	var dataString = 'loadType='+ loadType +'&loadId='+ loadId;	$("#"+loadType+"_loader").show(); 
	$("#"+loadType+"_loader").fadeIn(400).html('Please wait... <img src="http://headwaytechnologies.in/images/loading.gif" />');	
	$.ajax({
		type: "POST",
		url: "http://headwaytechnologies.in/product/loadDataPro",
		data: dataString,
		cache: false,	
		success: function(result){
				$("#"+loadType+"_loader").hide();
				$("#"+loadType+"_dropdown").html("<option value='-1'>Select "+loadType+"</option>"); 
				$("#"+loadType+"_dropdown").append(result);  		
				}	
		});
}
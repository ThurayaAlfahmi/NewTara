'use strict';
var pLeft=200;
var pWidth=300;
var picker=new Datepicker();
var pickElm=picker.getElement();
function xcalnder(valx,hdx,gdx){
	pickElm.style.position='absolute';
	pickElm.style.left=pLeft+'px';
	pickElm.style.top='172px';
	picker.attachTo(document.body);
	picker.setFirstDayOfWeek(0);
	picker.setTheme('green');
	picker.setLanguage('ar');
	picker.onPicked=function(){
		let elgd=document.getElementById(gdx);
		let elhd=document.getElementById(hdx);
		if(picker.getPickedDate() instanceof Date){
			elgd.value=picker.getPickedDate().getDateString();
			elhd.value=picker.getOppositePickedDate().getDateString()
		}else{
			elhd.value=picker.getPickedDate().getDateString();
			elgd.value=picker.getOppositePickedDate().getDateString()
			
		}
	};
	pickDate(valx,hdx);
}
	function updateWidth(el){
		pWidth=parseInt(el.value);
		if(!fixWidth()){
			document.getElementById('valWidth').value=pWidth;
			picker.setWidth(pWidth)
		}
	}
	
	function pickDate(ev,hddx){
		ev=ev||window.event;
		let el=ev.target||ev.srcElement;
		pLeft=ev.pageX;
		fixWidth();
		pickElm.style.top=ev.pageY+'px';
		picker.setHijriMode(el.id==hddx);
		picker.show();
		el.blur()
	}
	
	
	function fixWidth(){
		let docWidth=document.body.offsetWidth;
		let isFixed=false;
		if(pLeft+pWidth>docWidth)pLeft=docWidth-pWidth;
		if(docWidth>=992&&pLeft<200)pLeft=200;
		else if(docWidth<992&&pLeft<0)pLeft=0;
		if(pLeft+pWidth>docWidth){
			pWidth=docWidth-pLeft;
			picker.setWidth(pWidth);
			document.getElementById('valWidth').value=pWidth;
			document.getElementById('sliderWidth').value=pWidth;
			isFixed=true
		}
		pickElm.style.left=pLeft+'px';
		return isFixed
	}


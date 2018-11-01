$(document).ready(function() {
$(".AccordionPanelTab").click(function(){
				
				$(this).parent("li").prevAll("li").children(".AccordionPanelTabOpen").removeClass("AccordionPanelTabOpen");
				$(this).parent("li").nextAll("li").children(".AccordionPanelTabOpen").removeClass("AccordionPanelTabOpen");
				$(this).parent("li").prevAll("li").children(".AccordionPanelContent").animate({height:"0px"});
				$(this).parent("li").nextAll("li").children(".AccordionPanelContent").animate({height:"0px"});
				$(this).next(".AccordionPanelContent").animate({height:$(this).next(".AccordionPanelContent").children(".AccordionPanelContentClip").height()+20+"px"});
				$(this).addClass("AccordionPanelTabOpen");
			});
	
});
$(window).load(function() {

	

}); 
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Anton&family=Bebas+Neue&family=Bitter:ital,wght@0,400;0,700;1,400;1,700&family=East+Sea+Dokdo&family=Goldman:wght@400;700&family=Hanalei+Fill&family=Kufam:ital,wght@0,400;0,700;1,700&family=Pirata+One&family=Poppins:ital,wght@0,400;0,700;1,400;1,700&family=Raleway:ital,wght@0,400;0,700;1,400;1,700&family=Redressed&family=Roboto+Condensed:ital,wght@0,400;0,700;1,400;1,700&family=Slabo+27px&family=Yeon+Sung&display=swap" rel="stylesheet"> 
<link href="https://fonts.googleapis.com/css2?family=Alice&family=Lustria&family=Spectral&family=Spectral+SC&display=swap" rel="stylesheet"> 
<link type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

<script src="<?php echo base_url().'/public/Easylearn/js/zwibbler-demo.js';?>"></script>

<style>
    zwibbler 
    {
        position: absolute;
        left: 0;
        right: 0;
        top: 0;
        bottom: 0;
        display: flex;
        flex-flow: row nowrap;
    }

    .tools 
    {
        background: #f5f5f5;
        flex: 0 0 203px;
        display:flex;
        flex-flow: column nowrap;
        overflow-y: scroll;
        padding: 10px;
        font-family: Ubuntu;
    }

    [z-canvas] 
    {
        flex: 1 1 auto;
    }

    .tools button 
    {
        font-family: inherit;
        font-size: 100%;
        padding: 5px;
        display: block;
        background-color: white;
        border: none;
        border-radius: 2px;
        border-bottom: 2px solid #ddd;
        width: 100%;
    }

    .tools button[tool] 
    {
        display: inline-block;
        width: 60px;
        height: 60px;
        font-size: 30px;
    }

    .tools button.option 
    {
        border: 0;
        padding: 10px;
        border-radius: 3px;
        background: transparent;
        text-align: left;
    }

    .tools button.selected 
    {
        background: #dbe6d7;
    }

    .tools button.hover 
    {
        background: #ddd;
    }

    .tools hr 
    {
        border: none;
        border-top: 1px solid #ccc;
    }

    .tools select 
    {
        width: 100%;
    }

    [swatch] 
    {
        border: 1px solid black;
        display: inline-block;
        height: 2em;
        width: 4em;
        vertical-align:middle;
        margin-right: 10px;
    }

    .colour-picker 
    {
        padding: 10px 0;
    }

    .pages 
    {
        flex: 0 0 100px;
        background: #ccc;
        display: flex;
        flex-flow: row nowrap;
        overflow-x: scroll;
        overflow-y: hidden;
        align-items: center;
    }

    .page 
    {
        border: 3px solid transparent;
        margin: 5px;
        display: inline-block;
        box-shadow: 2px 2px 2px rgba(0,0,0,0.2);
    }

    .page.selected 
    {
        border: 3px solid orange;
    }

    [z-popup] 
    {
        background: #ccc;
        padding: 10px;
        box-shadow: 2px 2px 2px rgba(0,0,0.2);
    }
</style>

<zwibbler showToolbar="false" pageView="false" showDebug="false" allowTextInShape="false" z-init="filename='drawing'">
    <div class="tools">
        <div>
            <button tool z-click="ctx.usePickTool()" title="Select" z-selected="ctx.getCurrentTool()=='pick'">
                <i class="fas fa-mouse-pointer"></i>
            </button>

            <button tool z-click="ctx.useBrushTool()" title="Draw" z-class="{selected:ctx.getCurrentTool()=='brush'}">
                <i class="fas fa-pencil-alt"></i>
            </button>

            <button tool z-click="ctx.useLineTool()" title="Lines" z-class="{selected:ctx.getCurrentTool()=='line'}">
                <i class="fas fa-draw-polygon"></i>
            </button>

            <button tool z-click="ctx.useRectangleTool()" title="Rectangle" z-class="{selected:ctx.getCurrentTool()=='rectangle'}">
                <i class="fas fa-square"></i>
            </button>

            <button tool z-click="ctx.useCircleTool()" title="Circle" z-class="{selected:ctx.getCurrentTool()=='circle'}">
                <i class="fas fa-circle"></i>
            </button>

            <button tool z-click="ctx.useShapeTool('SvgNode', {fillMode:'custom',width:200,url:'data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/PjxzdmcgaWQ9IkxheWVyXzFfMV8iIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDE2IDE2OyIgdmVyc2lvbj0iMS4xIiB2aWV3Qm94PSIwIDAgMTYgMTYiIHhtbDpzcGFjZT0icHJlc2VydmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiPjxwYXRoIGQ9Ik04LjYxMiwyLjM0N0w4LDIuOTk3bC0wLjYxMi0wLjY1Yy0xLjY5LTEuNzk1LTQuNDMtMS43OTUtNi4xMiwwYy0xLjY5LDEuNzk1LTEuNjksNC43MDYsMCw2LjUwMmwwLjYxMiwwLjY1TDgsMTYgIGw2LjEyLTYuNTAybDAuNjEyLTAuNjVjMS42OS0xLjc5NSwxLjY5LTQuNzA2LDAtNi41MDJDMTMuMDQyLDAuNTUxLDEwLjMwMiwwLjU1MSw4LjYxMiwyLjM0N3oiLz48L3N2Zz4='}, 200, 200)">
                <i class="fas fa-heart"></i>
            </button>

            <button tool z-click="ctx.usePolygonTool(10, 0, 0.5)">
                <i class="fas fa-star"></i>
            </button>

            <button tool z-click="ctx.useTextTool()" title="Text" z-class="{selected:ctx.getCurrentTool()=='text'}">
                <i class="fas fa-font"></i>
            </button>

            <button tool z-click="ctx.insertImage()" title="Insert image">
                <i class="fas fa-image"></i>
            </button>

            <button tool z-click="ctx.cut()" title="Cut">
                <i class="fas fa-cut"></i>
            </button>

            <button tool z-click="ctx.copy()" title="Copy">
                <i class="fas fa-copy"></i>
            </button>

            <button tool z-click="ctx.paste()" title="Paste">
                <i class="fas fa-paste"></i>
            </button>

            <button tool z-click="ctx.undo()" z-disabled="!ctx.canUndo()">
                <i class="fas fa-undo"></i>
            </button>

            <button tool z-click="ctx.redo()" z-disabled="!ctx.canRedo()">
                <i class="fas fa-redo"></i>
            </button>

            <button tool z-click="ctx.zoomIn()">
                <i class="fas fa-search-plus"></i>
            </button>

            <button tool z-click="ctx.setZoom('page')">
                <i class="fas fa-compress-arrows-alt"></i>
            </button>

            <button tool z-click="ctx.zoomOut()">
                <i class="fas fa-search-minus"></i>
            </button>
        </div>
        
        <button z-show-popup="my-menu">Download</button>

        <div z-has="AnyNode">
            <h3>Shape options</h3>

            <button z-click="ctx.deleteNodes()">Delete</button>
            <button z-click="ctx.bringToFront()">
                Move to front
            </button>

            <button z-click="ctx.sendToBack()">
                Send to back
            </button>
        </div>

        <div z-has="fontName">
            <h4>Font</h4>

            <select z-property="fontName">
                <option>Alice</option>
                <option>Arial</option>
                <option>Times New Roman</option>
                <option>Pacifico</option>
                <option>Anton</option>
                <option>Bebas Neue</option>
                <option>Bitter</option>
                <option>East Sea Dokdo</option>
                <option>Goldman</option>
                <option>Hanalei Fill</option>
                <option>Kufam</option>
                <option>Lustria</option>
                <option>Pirata One</option>
                <option>Poppins</option>
                <option>Raleway</option>
                <option>Redressed</option>
                <option>Roboto Condensed</option>
                <option>Slabo 27px</option>
                <option>Spectral</option>
                <option>Spectral SC</option>
                <option>Yeon Sung</option>
            </select>
        </div>

        <div z-has="fontSize">
            <h4>Font size</h4>

            <select z-property="fontSize">
                <option>8</option>
                <option>10</option>
                <option>12</option>
                <option>20</option>
                <option>24</option>
                <option>50</option>
                <option>60</option>
                <option>70</option>
                <option>80</option>
                <option>90</option>
                <option>100</option>
            </select>
        </div>

        <div z-has="textAlign">
            <h4>Text alignment</h4>

            <select z-property="textAlign">
                <option>left</option>
                <option>center</option>
                <option>right</option>
            </select>
        </div>

        <div z-has="fillStyle">
            <h3>Colours</h3>

            <div class="colour-picker" z-has="fillStyle">
                <div swatch z-property="fillStyle" z-colour></div>
                Fill style
            </div>

            <div class="colour-picker" z-has="strokeStyle">
                <div swatch z-property="strokeStyle" z-colour></div>
                Outline
            </div>

            <div class="colour-picker" z-has="background">
                <div swatch z-property="background" z-colour></div>
                Background
            </div>
        </div>

        <div z-has="arrowSize">
            <h3>Arrows</h3>

            <button class="option" z-property="arrowSize" z-value="0">None</button>
            <button class="option" z-property="arrowSize" z-value="10">Small</button>
            <button class="option" z-property="arrowSize" z-value="15">Large</button>
            <hr>
            <button class="option" z-property="arrowStyle" z-value="solid">Solid</button>
            <button class="option" z-property="arrowStyle" z-value="open">Open</button>
        </div>

        <div z-has="lineWidth">
            <h3>Line width</h3>

            <select z-property="lineWidth">
                <option value="0">None</option>
                <option>1</option>
                <option>2</option>
                <option>4</option>
                <option>8</option>
            </select>
        </div>

        <div z-has="dashes">
            <h3>Line style</h3>

            <button class="option" z-property="dashes" z-value="">Solid</button>
            <button class="option" z-property="dashes" z-value="3,3">Dots</button>
            <button class="option" z-property="dashes" z-value="8,2">Dashes</button>
        </div>

        <div z-has="opacity">
            <h3>Opacity</h3>
            
            <input z-property="opacity" type="range" min="0.1" max="1.0" step="0.05">
        </div>
    </div>

    <div style="display:flex;flex-flow:column;flex: 1 1 auto;min-width:0">
        <div z-canvas></div>

        <div class="pages">
            <button title="Insert page" z-click="ctx.insertPage()"><i class="fas fa-plus"></i></button>
            <button title="Delete page" z-click="ctx.deletePage()"><i class="fas fa-minus"></i></button>

            <div z-sort="ctx.movePage($from, $to)">
                <div z-for='mypage in ctx.getPageCount()' z-page="mypage" draggable="TRUE" z-sortable z-height="70" class="page" z-selected="mypage==ctx.getCurrentPage()" z-click="ctx.setCurrentPage(mypage)">
                </div>
            </div>
        </div>
    </div>

    <div z-popup="my-menu" z-click-dismiss>
        Filename: <input z-model='filename' z-focus><br>

        <button z-click="ctx.download('png', filename+'.png')">PNG</button>
        <button z-click="ctx.download('jpg', filename+'.jpg')">JPG</button>
        <button z-click="ctx.download('svg', filename+'.svg')">SVG</button>
        <button z-click="ctx.download('pdf', filename+'.pdf')">PDF</button>
    </div>

</zwibbler>

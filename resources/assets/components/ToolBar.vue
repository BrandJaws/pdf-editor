<style>
.toolbar-container {
    display: flex;
    width: 100%;
    flex-direction: row;
    overflow-x: auto;
}
.toolbar-container > .toolbar-section {
    display: flex;
    flex-direction: column;
    flex: 0 1 auto;
    border-right: 1px solid #e6e6e6;
    padding: 10px 10px 0 10px;
    height: 155px;
}

.toolbar-container > .toolbar-section:last-child {
    border-right: 0;
}

.toolbar-section .sub-section {
    display: flex;
    flex-direction: row;
}

.toolbar-section .sub-section > div {
    display: flex;
    flex-direction: column;
}

.section-row-btn,
.section-main-btn {
    outline: none;
    background: none;
    padding: 1px 3px;
    border: 2px transparent;
}

.section-row-btn:hover,
.section-main-btn:hover {
    border-color: #2e84dc;
    background-color: rgba(53, 152, 220, 0.46);
}

.section-row-btn {
    line-height: 30px;
    display: flex;
    min-width: 120px;
}

.section-row-btn i {
    display: inline-flex !important;
    justify-content: center;
    align-items: center;
    font-size: 18px;
    width: 28px;
    height: 28px;
    border: 1px dashed #CCCCCC;
    margin-right: 10px;
    text-align: center;
}

.section-main-btn[disabled],
.section-row-btn[disabled],
.section-btn-sm[disabled] {
    cursor: not-allowed;
    pointer-events: none;
    opacity: 0.5;
}

.section-row-btn .rotate-right-icon {
    -webkit-transform: scaleX(-1);
    -moz-transform: scaleX(-1);
    transform: scaleX(-1);
}

.section-main-btn {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

.section-main-btn i {
    display: inline-flex !important;
    justify-content: center;
    align-items: center;
    width: 75px;
    height: 75px;
    border: 1px dashed #CCCCCC;
    font-size: 32px !important;
}

.section-main-btn span {
    margin-top: 5px;
}

.section-title {
    text-align: center;
    width: 100%;
    padding: 5px;
    margin-bottom: 0;
    letter-spacing: 1px;
    margin-top: auto;
    font-size: 16px;
}

.section-row {
    display: flex;
    flex-direction: row;
    padding: 3px;
}

.section-row .section-row-column {
    display: flex;
    flex-direction: row;
    flex: 0 1 auto;
}

.section-row > i {
    display: inline-flex !important;
    justify-content: center;
    align-items: center;
    font-size: 18px;
    width: 28px;
    height: 28px;
    border: 1px dashed #CCCCCC;
    margin-right: 10px;
    text-align: center;
}

.section-row > input {
    max-width: 100px;
    height: 28px;
}

.section-btn-sm {
    display: inline-flex !important;
    justify-content: center;
    align-items: center;
    font-size: 18px;
    width: 28px;
    height: 28px;
    border: 1px dashed #CCCCCC;
    margin-right: 1px;
    background: none;
    text-align: center;
}

.section-btn-sm:last-of-type {
    margin-right: 10px;
}

.section-btn-sm:hover {
    border-color: #2e84dc;
    background-color: rgba(53, 152, 220, 0.46);
}

.section-row-column select {
    width: 71px;
    background: none;
}

.section-row > .btn-group {
    width: 100%;
}

.section-row > .btn-group button {
    background: none;
    border: 0;
    outline: none;
    display: block;
    width: 100%;
    height: 28px;
    line-height: 18px;
    border-radius: 0;
    text-align: left;
}

.section-row > .btn-group button:hover {
    border-color: #2e84dc;
    background-color: rgba(53, 152, 220, 0.46);
}

.pdf-editor-preview {
    display: flex;
    width: 96vw;
    height: calc(100vh - 235px);
    flex-direction: row;
    justify-content: flex-start;
    align-items: flex-start;
    flex-wrap: wrap;
    padding: 10px;
}
</style>
<template>
    <div class="toolbar-container">
        <div class="toolbar-section">
            <div class="sub-section">
                <div class="sub-section-left">
                    <button class="section-row-btn"  ng-click="invertSelection()" ng-disabled="!pdfPagesSelected">
                        <i class="fa fa-exchange"></i> <span>Invert</span>&nbsp;<span ng-disabled="!controlKeyActive">(Ctrl + i)</span>
                    </button>
                    <button class="section-row-btn" ng-click="selectAll()"  ng-disabled="blobFiles.length === 0">
                        <i class="fa fa-th-list"></i> <span>Select All</span>&nbsp;<span ng-disabled="!controlKeyActive">(Ctrl + a)</span>
                    </button>
                    <button class="section-row-btn" ng-click ="selectNone()" ng-disabled="totalPageSelected < 2">
                        <i class="fa fa-ban"></i> <span>Select None</span>&nbsp;<span ng-disabled="!controlKeyActive">(Ctrl + o)</span>
                    </button>
                </div>
            </div>
            <p class="section-title">Selection</p>
        </div>
        <div class="toolbar-section">
            <div>
                <button class="section-row-btn" ng-disabled="state.isUndoDisabled()" ng-click="undo()">
                    <i class="fa fa-undo"></i> <span>Undo</span>&nbsp;<span ng-disabled="!controlKeyActive">(Ctrl + z)</span>
                </button>
                <button class="section-row-btn" ng-disabled="state.isRedoDisabled()" ng-click="redo()">
                    <i class="fa fa-repeat"></i> <span>Redo</span>&nbsp;<span ng-disabled="!controlKeyActive">(Ctrl + y)</span>
                </button>
                <button class="section-row-btn" ng-disabled="state.isRevertDisabled()" ng-click="revert()" >
                    <i class="fa fa-undo"></i> <span>Revert</span>&nbsp;<span ng-disabled="!controlKeyActive">(Ctrl + e)</span>
                </button>
            </div>
            <p class="section-title">Edit</p>
        </div>
        <div class="toolbar-section">
            <div>
                <button class="section-main-btn" ng-click="deleteSelectedPdfPages()" ng-disabled="!pdfPagesSelected">
                    <i class="fa fa-trash-o"></i> <span>Delete</span>
                </button>
            </div>
            <p class="section-title">Pages</p>
        </div>
        <div class="toolbar-section">
            <div>
                <button class="section-row-btn" ng-disabled="selectedInsertionPoint == -1 || !pdfPagesSelected" ng-click="moveItems()">
                    <i class="fa fa-copy"></i> <span>Move</span>
                </button>
                <button class="section-row-btn" ng-disabled="selectedInsertionPoint == -1 || !pdfPagesSelected" ng-click="copyItems()">
                    <i class="fa fa-copy"></i> <span>Copy</span>
                </button>
            </div>
            <p class="section-title">Insert</p>
        </div>
        <div class="toolbar-section">
            <div>
                <button class="section-row-btn" ng-disabled = "isSplitButtonDisabled() " ng-click="split()">
                    <i class="fa fa-columns"></i> <span>Split</span>
                </button>
                <button class="section-row-btn" ng-disabled="isJoinButtonDisabled()" ng-click="join()" >
                    <i class="fa fa-unlink"></i> <span>Unsplit</span>
                </button>
            </div>
            <p class="section-title">Segment</p>
        </div>
        <div class="toolbar-section">
            <div>
                <button class="section-row-btn" ng-click="rotateRight()" ng-disabled="!pdfPagesSelected">
                    <i class="fa fa-mail-reply fa-rotate-180 rotate-right-icon"></i> <span>Right</span>&nbsp;<span ng-disabled="!controlKeyActive">(Ctrl + r)</span>
                </button>
                <button class="section-row-btn" ng-click="rotateLeft()" ng-disabled="!pdfPagesSelected">
                    <i class="fa fa-mail-reply fa-rotate-360"></i> <span>Left</span>&nbsp;<span ng-disabled="!controlKeyActive">(Ctrl + l)</span>
                </button>
                <button class="section-row-btn" ng-click="rotatePage()" ng-disabled="!pdfPagesSelected">
                    <i class="fa fa-undo fa-rotate-180"></i> <span>180</span>&nbsp;<span ng-disabled="!controlKeyActive">(Ctrl + ArrowDown)</span>
                </button>
            </div>
            <p class="section-title">Rotate</p>
        </div>
        <div class="toolbar-section">
            <div>
                <button class="section-main-btn" ng-click="downScaleSelectedPages()" ng-disabled="!pdfPagesSelected">
                    <i class="fa fa-level-down"></i> <span>Downscale</span><span ng-disabled="!controlKeyActive">(Ctrl + d)</span>
                </button>
            </div>
            <p class="section-title">Quality</p>
        </div>
        <div class="toolbar-section">
            <div>
                <!--			<div class="section-row">-->
                <!--				<i class="fa fa-search"></i> <input type="text" />-->
                <!--			</div>-->
                <div class="section-row">
                    <div class="section-row-column">
                        <button class="section-btn-sm" ng-click="scaleDownPdfPreview()" ng-disabled="!pdfPagesSelected">
                            <i class="fa fa-minus"></i>
                        </button>
                        <button class="section-btn-sm" ng-click="scaleUpPdfPreview()" ng-disabled="!pdfPagesSelected">
                            <i class="fa fa-plus"></i>
                        </button>
                    </div>
                    <div class="section-row-column">
                        <select id="zoomOption" name ="value" ng-model="zoomSelection.selected" ng-change="changePreviewScale($event)" ng-disabled="!pdfPagesSelected" ng-options="option.label for option in zoomDropDownOptions track by option.value">
                        </select>
                    </div>
                </div>
                <div class="section-row">
                    <div class="btn-group">
                        <!--					<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">-->
                        <!--						<i class="fa fa-angle-right"></i><i class="fa fa-angle-right"></i> More-->
                        <!--					</button>-->
                        <ul class="dropdown-menu">
                            <li><a href="#">Action</a></li>
                            <li><a href="#">Another action</a></li>
                            <li><a href="#">Something else here</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="#">Separated link</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <p class="section-title">Viewer</p>
        </div>
    </div>


</template>
<script>
export default {
    data(){
        return {}
    },
    methods:{

    }
}

</script>

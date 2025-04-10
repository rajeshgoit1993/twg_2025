<!-- Modal Popup css -->
<link type="text/css" rel="stylesheet" href="{{ asset('/resources/views/query/query_modal/modal-popup/css/modal-popup.css') }}" />

<!-- Lead Modal css -->
<link type="text/css" rel="stylesheet" href="{{ asset('/resources/views/query/query_modal/modal-popup/css/leadvalidation.css') }}" />

<style type="text/css">
   h1 {
      text-align: center;
      font-weight: 300;
      color: #777;
   }

   h1 span {
      font-weight: 600;
   }

   .container_timeline {
      width: 80%;
      padding: 50px 0;
      margin: 50px auto;
      position: relative;
      overflow: hidden;
   }

   .container_timeline:before {
      content: '';
      position: absolute;
      top: 0;
      left: 19px;
      width: 2px;
      height: 100%;
      background: #CCD1D9;
      z-index: 1;
   }

   .timeline-block {
      width: 100%;
      margin-bottom: 30px;
      display: flex;
      justify-content: space-between;
   }

   .timeline-block-right {
      float: none;
   }

   .timeline-block-left {
      float: none;
      direction: ltr;
   }

   .marker {
      width: 30px;
      height: 30px;
      border-radius: 50%;
      border: 2px solid #F5F7FA;
      background: #b8b8b8;
      margin-top: 10px;
      z-index: 9999;
      text-align: center;
      position: relative;
      left: 4px;
   }

   .marker.active {
      width: 40px;
      height: 37px;
      background: #5bd040;
      left: 0px;
   }

   .timeline-content {
      width: 95%;
      padding: 0 15px;
      color: #666;
   }

   i.fa.fa-check {
      display: none;
   }

   i.fa.fa-check.active {
      display: block !important;
      position: absolute;
      top: 0;
      right: 0;
      left: 0;
      bottom: 0;
      margin: auto;
      height: 50%;
      color: #fff;
   }

   .timeline-content h3 {
      margin-top: 8px;
      margin-bottom: 5px;
      font-size: 20px;
      font-weight: 500;
   }

   .timeline-content span {
      font-size: 15px;
      color: #a4a4a4;
   }

   .timeline-content p {
      font-size: 14px;
      line-height: 1.5em;
      word-spacing: 1px;
      color: #888;
   }
</style>


<style type="text/css">
.custom_border .row {
   padding: 5px 0px;
}

table.dataTable thead > tr > th {
   padding-right: 0px;
}

.table>tbody>tr>td,
.table>tbody>tr>th,
.table>tfoot>tr>td,
.table>tfoot>tr>th,
.table>thead>tr>td,
.table>thead>tr>th {
   /* Empty declaration block */
}

.custom_border .row {
   padding: 5px 0px;
}

.pfwmt {
   font-weight: 600;
   margin: 0px;
   text-align: left;
}

.font-size14 {
   font-size: 14px;
}

.font-weight500 {
   font-weight: 500;
}

.text-center {
   text-align: center;
}

.text-capitalize {
   text-transform: capitalize;
}

.text-lowercase {
   text-transform: lowercase;
}

.text-uppercase {
   text-transform: uppercase;
}

.lineHeight14 {
   line-height: 14px;
}

.lineHeight15 {
   line-height: 15px;
}

.padding-top10 {
   padding-top: 10px;
}

.padding-bottom10 {
   padding-bottom: 10px;
}

.border-top1 {
   border-top: 1px solid #ccc;
}

.border-bottom1 {
   border-bottom: 1px solid #ccc;
}

.makeflex {
   display: flex;
}

.flex110 {
   flex-grow: 1;
   flex-shrink: 1;
   flex-basis: 0%;
}

.flexcenter {
   display: flex;
   align-items: center;
}

.flexcenter > li.active,
.flexcenter > li.active > a:focus,
.flexcenter > li.active > a:hover {
   color: #008cff !important;
   border-bottom-color: #008cff !important;
}

.flexcenter > li > a.hover {
   color: #008cff !important;
   padding-bottom: 15px;
   border-bottom: 2px solid #008cff !important;
}

.flex-column {
   display: flex;
   flex-direction: column;
}
</style>
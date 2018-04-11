<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>


<div class="container">
    <div class="row">
        <div class="col-lg-12 ">
            <div class="row">
                <legend> <h1>اضافة فعالية</h1></legend>
            </div>

            <form method="post" id="add_event-form"  role="form" style="display: block; text-align: right;"
                  autocomplete="on" >

                <div class="control-group">
                    <input id="eventName" name="eventName" type="text" placeholder="عنوان الفعالية" class="input-xlarge" required="">
                    <label type="text"  ata-toggle="tooltip" data-placement="bottom" title="اسم الفعالية">عنوان الفعالية</label>

                </div>


                <div class="control-group">

                                      <lable>  تفاصيل الفعالة</label>

                    <textarea class="form-control text-right" rows="4" name="description"
                              placeholder="تفاصيل الفعالية" tabindex="3"  ata-toggle="tooltip" data-placement="bottom" title="تفاصيل الفعالية"></textarea> 
                </div>

                <!-- Text input-->

                <label class="control-label" for="address">موقع الفعالية</label>
                <div class="controls">
                    <input id="address" name="address" type="text" placeholder="موقع الفعالية" class="input-xlarge" required="">

                </div>

            
                <!-- File Button --> 
                <div class="control-group">
                    <label class="control-label" for="image">صورة</label>
                    <div class="controls">
                        <input id="image" name="image" class="input-file" type="file" style="text-align: right">
                    </div>
                </div>

                <!-- Button (Double) -->
                <div class="control-group">
                    <label class="control-label" for="button1id"></label>
                    <div class="controls">
                        <button id="button1id" name="button1id" class="btn btn-success">حفظ</button>
                        <button class="btn btn-danger" onclick="openTab(event, 'events')" id="defaultOpen">الغاء</button>
                    </div>
                </div>

            </form>

        </div></div></div>


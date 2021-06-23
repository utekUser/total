<div class="path-l">
	<div class="path-r">
		<div class="path-m">
			<div class="path">
                <?php echo $this->path; ?>
			</div>
			<div class="module-name">
                <?php echo $this->header; ?>
			</div>
		</div>
	</div>
</div>

<style>
table.adminedit{background-color: #FFFFFF;margin: 0px;padding: 0px;border: 1px solid #ddd;border-spacing: 0px;width: 50%;border-collapse: collapse;}
table.adminedit input[type="text"],table.adminedit select,table.adminedit textarea{width:70%;padding:1px 3px;}
table.adminedit textarea{height:120;}
table.adminedit td,table.adminedit th{border: 1px solid #e5e5e5;padding:4px;}
table.adminedit a,table.adminedit a:visited{text-decoration:none;}		

div.element-hint {color:#A6A6A6;font-size:10px;}
</style>

<form enctype="multipart/form-data" method="post" action="/admin/shop/catalog/?import=1">
    <table border="0" class="adminedit">
        <tbody>
            <tr>
                <td width="20%" valign="top">
                    <b>Загрузить базу</b>
                </td>
                <td>
                    <input type="file" name="file" value="" id="file" />
                    <!--<div class="element-hint">формат: .zip</div>-->
                </td>
            </tr>
            <tr>
                <td colspan="2" style="text-align:center;">
                    <input style="width:150px;" type="submit" name="button" id="button" value="Загрузить" />
                </td>
            </tr>
            <tr>
                <td colspan="2" style="text-align:left;">
                    Товары, которых нет в файле данных: <br />
                    <input type="radio" value="deact" name="outFileAction" checked="checked"> деактивировать<br />
                    <input type="radio" value="leave" name="outFileAction"> оставить как есть
                </td>
            </tr>
            <tr>
                <td colspan="2" style="text-align:center;">
                    <input style="width:150px;" class="default" type="submit" value="Обновить базу" name="_update">
                </td>
            </tr>
        </tbody>
    </table>
</form>
/* Generate standard input */
input_select = `
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label for="product_id[]">Product</label>
                <select id="select2" class="form-control select2" name="product_id[]">
                <option selected="selected" value="">Product</option>
`;

/* generate options */
for (var i = 0; i < products.length; i++) {
    input_select += "       <option value='" + products[i].id + "'>" + products[i].name + "</option>";
}

/* Close standard input */
input_select += `
                </select>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="quantity[]">Quantity</label>
                <input class="form-control" placeholder="Quantity" name="quantity[]" type="number" value="" id="quantity[]">
            </div>
        </div>
    </div>
`;

/* append function */
$(function() {
    $('#more').click(function(e) {
        e.preventDefault();
        $("#fieldlist").append(input_select);
        $('.select2').select2();
    });
});

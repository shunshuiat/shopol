function checkDeleteNhanHieu(maNH, tenNH) {
    let isOk = confirm("Bạn có muốn xóa nhãn hiệu "+tenNH);
    if (isOk) {
        location.replace("delete.php?maNH="+maNH);
    } 
}
function checkDeleteLoaiSanPham(maLSP, tenLSP) {
    let isOk = confirm("Bạn có muốn xóa loại sản phẩm "+tenLSP);
    if (isOk) {
        location.replace("delete.php?maLSP="+maLSP);
    } 
}
function checkDeleteSanPham(maSP, tenSP) {
    let isOk = confirm("Bạn có muốn xóa sản phẩm "+tenSP);
    if (isOk) {
        location.replace("delete.php?maSP="+maSP);
    } 
}
function sortByPrice() {
    let objOption = document.getElementById("optPrice");
    window.location = "?sort=" + objOption.value;
}

function checkDelete(maSP, tenSP) {
    let isOk = confirm("Bạn có muốn xóa sản phẩm "+tenSP);
    if (isOk) {
        location.replace("shopping_remove.php?maSP="+maSP);
    }
}


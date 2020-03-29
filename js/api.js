const createFolder = document.getElementById('createFolder');
const imageUpload = document.getElementById('imageUpload');

const createFolderUi = document.getElementById('createFolderUi');
const btnCreateFolderCancel = document.getElementById('btnCreateFolderCancel');

const imageUploadUi = document.getElementById('imageUploadUi');
const btnImageUploadCancel = document.getElementById('btnImageUploadCancel');

const background = document.getElementById('background');

createFolder.addEventListener('click', () => {
  background.style.display = "";
  createFolderUi.style.display = "";
});

imageUpload.addEventListener('click', () => {
  background.style.display = "";
  imageUploadUi.style.display = "";
});

btnCreateFolderCancel.addEventListener('click', () => {
  background.style.display = "none";
  createFolderUi.style.display = "none";
});

btnImageUploadCancel.addEventListener('click', () => {
  background.style.display = "none";
  imageUploadUi.style.display = "none";
})

function pageMove(folder_link) {
  const folder_name = document.getElementById('folder_name');
  var f = document.paging;
  f.folder_link.value = folder_link;
  f.action = "main.php";
  f.method = "post";
  f.submit();
}
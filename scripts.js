
mkdirBtn = document.getElementById("addressBar-newFolderBtn");
mkdirBtn.addEventListener("click",createNewFolder);

upBtn = document.getElementById("addressBar-up");
upBtn.addEventListener("click",navUp);

addressBar = document.getElementById('addressBar-input');
addressBar.addEventListener("change",addressBarOnChange);



directories = document.getElementsByClassName('directory');

for (let i = 0;i<directories.length;i++)
{
    directories[i].addEventListener("click",() => {
        folderSelect(i);
    });
}


files = document.querySelectorAll('.file');
for (let i = 0;i<files.length;i++)
{
    files[i].addEventListener("click",() => fileSelect(i));
    files[i].addEventListener("dblclick",fileOpen);
}

function createNewFolder()
{
    let folderName = prompt("Please enter the new folder name:");
    if (folderName !== null){
        sendMkdirReq(folderName);        
    }
    else
    {
        console.log("you entered null");
    }
    
}

async function sendMkdirReq(folderName)
{
    const url = `http://localhost/filebrowser/newfolder.php?foldername=${folderName}`;
    try
    {
        const response = await fetch(url);
        if (!response.ok)
        {
            throw new Error(`Response status: ${response.status}`);
        }
        const result = await response.json();
        if (result.success)
        {
            console.log(result.data);
            window.location.href = "http://localhost/filebrowser/index.php";
        }
    }
    catch (error)
    {
        console.log("Error:",error.message);
    }
     
}



function navUp()
{
    sendChdirReq('__1_up');
}


async function sendChdirReq(newPath)
{
    const url = `http://localhost/filebrowser/changeFolder.php?pathname=${newPath}`;
    try
    {
        const response = await fetch(url);
        if (!response.ok)
        {
            throw new Error(`Response status: ${response.status}`);
        }
        const result = await response.json();
        if (result.success)
        {
            window.location.href = "http://localhost/filebrowser/index.php";
        }
    }
    catch (error)
    {
        console.error(error);
    }
     
}

function getCookie(cname) {
  let name = cname + "=";
  let decodedCookie = decodeURIComponent(document.cookie);
  let ca = decodedCookie.split(';');
  for(let i = 0; i <ca.length; i++) {
    let c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}

function setCookie(cname, cvalue, exdays,path) {
  const d = new Date();
  d.setTime(d.getTime() + (exdays*24*60*60*1000));
  let expires = "expires="+ d.toUTCString();
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=" + path;
}

function addressBarOnChange(event)
{
    const newPath = event.target.value;
    setCookie('currentPath',newPath,10,"/filebrowser");
    window.location.href = "http://localhost/filebrowser/index.php";
}


function folderSelect(index)
{
    for (let i = 0;i<directories.length;i++)
    {
        directories[i].classList.remove("selected");
    }
    for (let i = 0;i<files.length;i++)
    {
        files[i].classList.remove("selected");
    }
    directories[index].classList.add("selected");
}

function fileSelect(index)
{
    for (let i = 0;i<directories.length;i++)
    {
        directories[i].classList.remove("selected");
    }
    for (let i = 0;i<files.length;i++)
    {
        files[i].classList.remove("selected");
    }

    files[index].classList.add("selected");
}



function folderOpen(event)
{
    folderName = event.currentTarget.querySelector('p').innerHTML;
    oldPath = getCookie('currentPath');
    newPath = oldPath + '\\' + folderName;
    setCookie('currentPath',newPath,10,"/filebrowser");     
    window.location.href = "http://localhost/filebrowser/index.php";
}

function fileOpen(event)
{
    fileName = event.currentTarget.querySelector('p').innerHTML;
    oldPath = getCookie('currentPath');
    newPath = oldPath + '\\' + fileName;
    console.log("The file should be opened.");
}

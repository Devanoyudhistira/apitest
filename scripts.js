async function post(input) {
  const jadi = await fetch(`http://localhost/apitest/api/post.php?d=${input}`, {
    method: "post",
    body: { deskripsi: "oke" },
  })
    .then((response) => response.json())
    .then((e) => {
      const paragraph = document.createElement("li");
        paragraph.setAttribute("data-id", e["id"]);
        paragraph.textContent = e["request"];
        document.querySelector("ul").appendChild(paragraph)
    })
    .catch((err) => console.error(`anda mendapat error berikut ${err}`));
}
async function deletedata(input) {
  const jadi = await fetch(`http://localhost/apitest/api/post.php?d=${input}`, {
    method: "delete",
    body: { deskripsi: "oke" },
  })
    .then((response) => response.json())
    .then(() => hasil("http://localhost/apitest/api/get.php"))
    .catch((err) => console.error(`anda mendapat error berikut ${err}`));
}
async function hasil(source) {
  const jadi = await fetch(source, {
    method: "get",
  })
    .then((Response) => Response.json())
    .then((res) => {
      res["data"].forEach((element) => {
        const paragraph = document.createElement("li");
        paragraph.setAttribute("data-id", element["id"]);
        paragraph.textContent = element["name"];
        document.querySelector("ul").appendChild(paragraph);
      });
    });
}

const formulir = document.querySelector("#create");

formulir.addEventListener("submit", async (e) => {
  e.preventDefault();
  const inputText = document.querySelector("input").value;
  post(inputText);
});

const inputsearch = document.querySelector("#search");

const cari = async (keyword) => {
  const link = `http://localhost/apitest/api/search.php?s=${keyword}`;
  await fetch(link)
    .then((results) => results.json())
    .then(
      (data) =>
        (document.querySelector("ul").textContent = data["data"]["name"])
    )
    .catch(
      (err) =>
        (document.querySelector("ul").textContent = "data tidak ditemukan")
    );
};

inputsearch.addEventListener("input", (e) => {
  if (inputsearch.value.length > 0) {
    cari(inputsearch.value);
  } else if (inputsearch.value.length === 0) {
    document.querySelector("ul").textContent = "";
    hasil("http://localhost/apitest/api/get.php");
  }
});

function uploadFile() {
  const fileInput = document.getElementById('fileInput');
  const file = fileInput.files[0];
  
  if (file) {
      const formData = new FormData();
      formData.append('file', file);
      
      fetch(`http://localhost/apitest/api/imagepost.php`, {
          method: 'POST',
          body: formData
      })
      .then(response => response.json())
      .then(data => {
          if (data.success) {
              console.log('File uploaded:', data.message);
              console.log(data)
          } else {
              console.error('Upload failed:', data.message);
          }
      })
      .catch(error => {
          console.error('Error:', error);
      });
  } else {
      console.error('No file selected');
  }
}

hasil("http://localhost/apitest/api/get.php");

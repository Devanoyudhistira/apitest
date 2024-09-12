async function post(input) {
  const jadi = await fetch(`http://localhost/apitest/api/post.php?d=${input}`, {
    method: "post",
    body: { deskripsi: "oke" },
  })
    .then((response) => response.json())
    .then((e) => {
      console.log(e["request"])
      const paragraph = document.createElement("li");
        paragraph.setAttribute("data-id", e["imageid"]);
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
        paragraph.setAttribute("data-id", element["imageid"]);
        paragraph.textContent = element["deskripsi"];
        document.querySelector("ul").appendChild(paragraph);
      });
    });
}

const formulir = document.querySelector("form");

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
        (document.querySelector("ul").textContent = data["data"]["deskripsi"])
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

hasil("http://localhost/apitest/api/get.php");

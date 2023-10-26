const admin = require("firebase-admin");
const serviceAccount = require("./serviceAccountKey.json");
const env = require('./env.json');
const express = require('express');
const app = express();
const port = env.port || 3000;

admin.initializeApp({
  credential: admin.credential.cert(serviceAccount),
  projectId: "pushteste-b690a",
});

app.use(express.json());

app.post('/send', (req, res) => {

  if (!req.body) {
    return res.sendStatus(400);
  }

  const sec_token = req.body.sec_token;
  const titulo = req.body.titulo;
  const corpo = req.body.mensagem;
  const tokens = req.body.tokens;

  if (!sec_token || sec_token !== env.sec_token) {
    console.log("Token de segurança inválido!");
    return res.sendStatus(401);
  }

  console.log("tokens", tokens);

  if (!tokens || !tokens.length) {
    console.log("Token não informado!");
    return res.sendStatus(400);
  }

  const qtdRange = 500;
  const qtdTokens = tokens.length;
  const qtdRangeTokens = Math.ceil(qtdTokens / qtdRange);

  for (let i = 0; i < qtdRangeTokens; i++) {
    const inicio = i * qtdRange;
    const fim = (i + 1) * qtdRange;
    const tokensRange = tokens.slice(inicio, fim);

    console.log("tokensRange", tokensRange);

    const mensagem = {
      notification: {
        title: titulo || "Título da Notificação",
        body: corpo || "Corpo da Notificação",
      },
      tokens: tokensRange,
    };

    admin.messaging().sendEachForMulticast(mensagem)
      .then((response) => {
        console.log("Mensagem enviada com sucesso:", response);
      })
      .catch((error) => {
        console.error("Erro ao enviar mensagem:", error);
      });
  }

  return res.sendStatus(200);
});

app.listen(port, '0.0.0.0', () => {
  console.log(`Push app listening at http://0.0.0.0:${port}`)
});


module.exports = {
  apps : [{
    name   : "jobtraq-fe",
    script : "./dist/angular-frontend/server/main.js",
    instances : "max",
    exec_mode : "cluster"
  }]
}

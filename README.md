### Build & Run

```bash
1) docker-compose up --build -d
2) cp .env.example .env
3) docker-compose exec -ti todo_php_1 bash
4) php artisan key:generate
5) php artisan migrate
```
Navigate to [http://localhost:80](http://localhost:80) 

Success! You can now start developing your Lumen app on your host machine and you should see your changes on refresh! Classic PHP development cycle. A good place to start is `images/php/app/routes/web.php`.


### Creating a custom network and make various containers communicate

- Run this command in terminal

`docker network create -d bridge my-bridge-network`

- Run following command to connect the containers

`docker run -itd --network=my-bridge-network php`




### Pushing Docker image to Docker Hub

- Generate the access token from Dockerhub portal by logging in, copy it to your clipboard. Go back to the terminal window and issue the command:

`docker login -u NAME`

Where NAME is your Docker Hub username. You will be prompted for your Docker Hub password, where you’ll use the access token you just generated.


- We already built our image from above commands so after that we need to push this image.

- We’re going to tag our new image and then push it to Docker Hub. First tag the image with :latest using the command:

`docker image tag trtest USER/trtest:latest`

Where USER is your Docker Hub username.

Now that the image is tagged, we can push it to Docker Hub with:


`docker image push USER/trtest:latest`

- When the push completes, you should find the trtest:latest image in your Docker Hub repository, and that’s all there is to building a Docker image and pushing it to your Docker Hub repository.
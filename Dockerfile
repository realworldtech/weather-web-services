FROM debian:jessie
MAINTAINER andrew@rwts.com.au

RUN apt-get -y update && \ 
  apt-get -y upgrade && \
  apt-get install -y --no-install-recommends vim screen curl python-pip libpq-dev libxml2-dev \
   libxslt1-dev python-dev git-core build-essential postgresql-client && \
  apt-get clean

RUN pip install -U setuptools pip
COPY requirements.txt .
RUN pip install -r requirements.txt

CMD /bin/bash
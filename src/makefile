build-dir=../build
lib-dir=lib
build-js-dir=${build-dir}/js

theme=green-icon


all: patch-analytics build

build:

	(mkdir ${build-dir})
	(touch ${build-dir}/theme-${theme}; rsync -avC --exclude ${mathjax}.zip lab/* lib/* help themes/${theme}/* ${build-dir})
        #(chmod 777 -R ${build-dir}/temp ${build-dir}/images  ${build-dir}/arith)
        #FIXME: should not happen in build directory, should change mode to 777 in deplyment directory!
        #(chmod -R 777 ${build-dir}/)



# don't remove the js directory, since copying it again with mathjax takes too long.
# http://superuser.com/questions/168130/unix-delete-files-and-folders-excluding-pattern
clean:
	(rm -rf ${build-dir})

patch-analytics:
	git clone https://github.com/virtual-labs/vlabs-analytics.git
	cp vlabs-analytics/gtm-patcher.py ../scripts/.
	cp vlabs-analytics/patch-analytics.sh ../scripts/.
	chmod +x ../scripts/patch-analytics.sh 
	../scripts/patch-analytics.sh
	rm -rf vlabs-analytics
	rm -rf ../scripts/patch-analytics.sh
	rm -rf ../scripts/gtm-patcher.py
